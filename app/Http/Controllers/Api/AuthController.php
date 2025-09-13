<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\OtpCode;
use App\Models\Profile;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;
use Validator;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Traits\ApiResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Google_Client;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use ApiResponse;

    public function requestOtpForRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nick_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation error', $validator->errors(), 422);
        }

        // Now check if email already exists
        if (User::where('email', $request->email)->exists()) {
            return $this->error('The email has already been taken. Please use a different email or login.');
        }

        $otp = rand(1000, 9999);

        // Cache user data temporarily (valid for 10 minutes)
        $cacheKey = 'otp_' . $request->email;
        Cache::put($cacheKey, [
            'name' => $request->name,
            'nick_name' => $request->nick_name,
            'email' => $request->email,
            'password' => $request->password,
            'otp' => $otp,
        ], now()->addMinutes(10));

        // Send email (make sure mail config is set)
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Your OTP for Registration');
        });

        return $this->success('OTP sent to your email');
    }

    public function verifyOtpAndRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation error', $validator->errors(), 422);
        }

        $cacheKey = 'otp_' . $request->email;
        $cachedData = Cache::get($cacheKey);

        if (!$cachedData || $cachedData['otp'] != $request->otp) {
            return $this->error('Invalid or expired OTP');
        }

        $user = User::create([
            'name' => $cachedData['name'],
            'nick_name' => $cachedData['nick_name'],
            'email' => $cachedData['email'],
            'status' => 2,
            'password' => Hash::make($cachedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        // ✅ Generate Firebase Custom Token
        $firebaseCustomToken = $this->syncWithFirebase($user);
        // Clear OTP from cache
        Cache::forget($cacheKey);

        return $this->success('User registered successfully', [
            'access_token' => $token,
            'firebase_custom_token' => $firebaseCustomToken,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'created_at' => $user->created_at,
            ]
        ]);
    }

    public function storeKyc(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'country' => 'required|string',
                'idType' => 'required|string',
                'idDocument' => 'required|file',
                'userPhoto' => 'required|file',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation error', $validator->errors(), 422);
            }

            $user = User::findOrFail($request->user_id);

            if ($user->kyc) {
                return $this->error('KYC info already exists for this user', [], 409);
            }

            // Store in public disk
            $idDocumentPath = $request->file('idDocument')->store('id_documents', 'public');
            $userPhotoPath = $request->file('userPhoto')->store('user_photos', 'public');

            // Save KYC
            $user->kyc()->create([
                'country' => $request->country,
                'id_type' => $request->idType,
                'id_document' => $idDocumentPath,
                'user_photo' => $userPhotoPath,
            ]);

            // Update user status
            $user->update(['status' => 3]);

            // Return with full public URLs
            return $this->success('KYC info stored successfully', [
                'user_id' => $user->id,
                'country' => $request->country,
                'id_type' => $request->idType,
                'id_document_url' => asset('storage/' . $idDocumentPath),
                'user_photo_url' => asset('storage/' . $userPhotoPath),
            ]);

        } catch (ValidationException $e) {
            return $this->error('Validation error', $e->errors(), 422);
        } catch (\Exception $e) {
            Log::error('KYC storing failed: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return $this->error('Something went wrong while storing KYC info', [], 500);
        }
    }

    public function storeProfile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'profile_photo' => 'image|max:9048',
                'gallery_photo1' => 'image|max:9048',
                'gallery_photo2' => 'image|max:9048',
                'gallery_photo3' => 'image|max:9048',
                'gallery_photo4' => 'image|max:9048',
                'gallery_photo5' => 'image|max:9048',
                'gallery_photo6' => 'image|max:9048',
                'fcm_token' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return $this->error('Validation error', $validator->errors(), 422);
            }

            $fcmToken = $request->input('fcm_token');
            $user = User::findOrFail($request->user_id);

            // Store images in public disk and retain old if not uploaded
            $images = [];
            foreach ([
                'profile_photo', 'gallery_photo1', 'gallery_photo2',
                'gallery_photo3', 'gallery_photo4', 'gallery_photo5', 'gallery_photo6'
            ] as $field) {
                $images[$field] = $request->hasFile($field)
                    ? $request->file($field)->store('profile_photos', 'public') // save in public/storage/profile_photos
                    : optional($user->profile)->$field; // keep existing
            }

            // Update profile_photo_path in users table
            if ($images['profile_photo']) {
                $user->update(['profile_photo_path' => $images['profile_photo'], 'fcm_token' => $fcmToken]);

                // ✅ Sync profile photo to Firebase
                try {
                    $firebase = (new Factory)
                        ->withServiceAccount(config('firebase.credentials'))
                        ->withDatabaseUri(config('firebase.projects.app.database.url')); // ✅ ensure correct URL

                    $database = $firebase->createDatabase();

                    $database->getReference('users/' . $user->id . '/profile_photo_url')
                        ->set(asset('storage/' . $images['profile_photo']));
                } catch (\Throwable $e) {
                    Log::error("Failed to sync profile photo to Firebase: " . $e->getMessage());
                }
            }

            $dob = $request->input('dob');
            $age = $dob ? Carbon::parse($dob)->age : null;
            // Prepare profile data
            $profileData = array_merge(
                $request->except([
                    'profile_photo', 'gallery_photo1', 'gallery_photo2',
                    'gallery_photo3', 'gallery_photo4', 'gallery_photo5', 'gallery_photo6'
                ]),
                $images,
                ['age' => $age]
            );

            // Create or update profile
            if ($user->profile) {
                $user->profile->update($profileData);
            } else {
                $user->profile()->create($profileData);
            }

            // Set user active
            $user->update(['status' => 1]);

            // Create token
            $token = $user->createToken('auth_token')->plainTextToken;

            // Return response
            return $this->success('Profile stored successfully', [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => $user->status,
                    'profile_photo_url' => $user->profile_photo_path
                        ? asset('storage/' . $user->profile_photo_path)
                        : null,
                    'created_at' => $user->created_at,
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error.',
                'error' => $e->errors(),
            ], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'A database error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'nick_name' => $request->nick_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $firebaseCustomToken = $this->syncWithFirebase($user);

        return $this->success('User registered successfully', [
            'access_token' => $token,
            'firebase_custom_token' => $firebaseCustomToken,
            'token_type' => 'Bearer'
        ]);
    }

    public function googleLogin(Request $request)
    {
        $request->validate(['id_token' => 'required']);

        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]); // OAuth 2.0 Client ID

        $payload = $client->verifyIdToken($request->id_token);

        if (!$payload) {
            return response()->json(['error' => 'Invalid Google token'], 401);
        }

        $user = User::updateOrCreate(
            ['email' => $payload['email']],
            [
                'name' => $payload['name'] ?? $payload['email'],
                'password' => bcrypt(\Illuminate\Support\Str::random(16)),
                'status' => 2,
                'nick_name' => $payload['given_name'] ?? null,
            ]
        );

        // Check if user is inactive
        if ($user->status == 0) {
            return $this->error('Your account is inactive. Please contact support.', [], 403);
        }

        Auth::login($user);

        $firebaseCustomToken = $this->syncWithFirebase($user);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['user' => $user, 'firebase_custom_token' => $firebaseCustomToken,  'access_token' => $token,'token_type' => 'Bearer'], 200);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'fcm_token' => 'nullable|string'
        ]);

        $fcmToken = $request->input('fcm_token');
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->error('Email address not found. Please register or check the email.', [], 404);
        }


        if (!Hash::check($request->password, $user->password)) {
            return $this->error('Incorrect password. Please try again.', [], 401);
        }

        if ($user->status == 0) {
            return $this->error('Your account is inactive. Please contact support.', [], 403);
        }

        if ($fcmToken) {
            $user->update(['fcm_token' => $fcmToken]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $firebaseCustomToken = $this->syncWithFirebase($user);

        return $this->success('Login successful', [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'firebase_custom_token' => $firebaseCustomToken,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'profile_photo' => $user->profile_photo_path,
                'created_at' => $user->created_at,
            ]
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function sendOtp(Request $request)
    {
        $contact = $request->input('contact');

        if (!$contact) {
            return response()->json(['error' => 'Contact is required.'], 400);
        }

        $otp = rand(1000, 9999);

        $data = [
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5)
        ];

        if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $contact;
            Mail::raw("Your OTP is: $otp", function ($message) use ($contact) {
                $message->to($contact)->subject('Your OTP Code');
            });
        } else {
            $data['mobile'] = $contact;
            // Here you can use an SMS gateway like Twilio/Fast2SMS
            // sendSms($contact, "Your OTP is: $otp");
        }

        OtpCode::create($data);

        return response()->json(['message' => 'OTP sent successfully.']);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact' => 'required',
            'otp' => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $contact = $request->contact;
        $otp = $request->otp;

        $query = OtpCode::where('otp', $otp)->where('expires_at', '>', now());

        if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            $query->where('email', $contact);
            $user = User::where('email', $contact)->first();
        } else {
            $query->where('mobile', $contact);
            $user = User::where('mobile', $contact)->first();
        }

        $otpRecord = $query->latest()->first();

        if (!$otpRecord) {
            return response()->json(['error' => 'Invalid or expired OTP.'], 400);
        }

        if ($user) {
            Auth::login($user);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message' => 'OTP verified, user not registered.',
                'redirect' => 'signup'
            ]);
        }
    }


    public function forgotPasswordApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation error', $validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error('Invalid user or not registered.');
        }

        $otp = rand(1000, 9999);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        $contact = $request->email;
        Mail::raw("Your OTP is: $otp", function ($message) use ($contact) {
                $message->to($contact)->subject('Your OTP Code');
            });

        return $this->success('OTP sent successfully');
    }

    public function forgotPasswordVerifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation error', $validator->errors(), 422);
        }

        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$reset) {
            return $this->error('Invalid OTP.');
        }

        return $this->success('OTP verified successfully');
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation error', $validator->errors(), 422);
        }

        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$reset) {
            return $this->error('Invalid OTP or email.');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return $this->success('Password has been reset successfully');
    }

    public function deleteUser(Request $request)
    {
        $user = $request->user();

        if ($user) {
            // 1. Delete from Firebase
            try {
                $firebase = (new Factory)
                    ->withServiceAccount(config('firebase.credentials'))
                    ->withDatabaseUri(config('firebase.projects.app.database.url'));

                // Delete from Firebase Realtime Database
                $firebase->createDatabase()
                    ->getReference('users/' . $user->id)
                    ->remove();

                // Delete from Firebase Auth
                $auth = $firebase->createAuth();
                try {
                    $firebaseUser = $auth->getUserByEmail($user->email);
                    $auth->deleteUser($firebaseUser->uid);
                } catch (UserNotFound $e) {
                    // Firebase user doesn't exist – safe to skip
                }
            } catch (\Throwable $e) {
                // Log Firebase deletion error, but don't stop local deletion
                Log::error("Firebase deletion failed for user ID {$user->id}: " . $e->getMessage());
            }

            // 2. Delete local user
            $user->tokens()->delete(); // Optional: revoke Sanctum tokens
            $user->delete(); // Or use ->forceDelete() if needed

            return $this->success('User account deleted successfully.');
        }

        return $this->error('Unauthorized or user not found.');
    }

    public function deleteUser_old(Request $request)
    {
        $user = $request->user();
        if ($user) {
            // Optional: Revoke all tokens if using Sanctum
            $user->tokens()->delete();

            $user->delete(); // Or soft delete if `SoftDeletes` is enabled
            return $this->success('User account deleted successfully.');
        }
        return $this->error('Unauthorized or user not found.');

    }

    public function googleLogin11(Request $request)
    {
        $request->validate(['id_token' => 'required']);

        $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->id_token);

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(\Illuminate\Support\Str::random(16)) // random password
            ]
        );

        Auth::login($user);

        $this->syncWithFirebase($user);

        return response()->json(['user' => $user], 200);
    }

    protected function syncWithFirebase($user)
    {
        $firebase = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->withDatabaseUri(config('firebase.projects.app.database.url'));

        // Realtime DB sync (optional)
        $firebase->createDatabase()
            ->getReference('users/' . $user->id)
            ->set([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

        // Firebase Auth
        $auth = $firebase->createAuth();

        try {
            $auth->getUserByEmail($user->email);
        } catch (UserNotFound $e) {
            $auth->createUser([
                'uid' => (string) $user->id,
                'email' => $user->email,
                'displayName' => $user->name,
                'password' => 'Default@123', // Optional: for web login
            ]);
        }

        // ✅ Generate custom Firebase token for the client to sign in
        return $auth->createCustomToken((string) $user->id)->toString();
    }

    protected function syncWithFirebase_old($user)
    {
        $firebase = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->withDatabaseUri(config('firebase.projects.app.database.url')); // ✅ Add this line

        // Sync to Firebase Realtime DB
        $firebase->createDatabase()
            ->getReference('users/' . $user->id)
            ->set([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

        // Sync to Firebase Auth
        $auth = $firebase->createAuth();

        try {
            $auth->getUserByEmail($user->email);
        } catch (UserNotFound $e) {
            $auth->createUser([
                'uid' => (string) $user->id,
                'email' => $user->email,
                'displayName' => $user->name,
                'password' => 'Default@123', // App handles auth
            ]);
        }
    }
}
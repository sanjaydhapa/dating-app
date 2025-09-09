<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;
use App\Models\User;
use Hash;
class FirebaseController extends Controller
{

    public function firebaseLogin(Request $request)
    {
        // Step 1: Validate request
        $request->validate([
            'uid' => 'required|string',
            'fcm_token' => 'nullable|string'
        ], [
            'uid.required' => 'UID is required.'
        ]);
    
        $uid = $request->input('uid');
        $fcmToken = $request->input('fcm_token');
    
        try {
            // Step 2: Initialize Firebase Auth
            $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
            $auth = $factory->createAuth();
    
            // Step 3: Get user info from Firebase
            $firebaseUser = $auth->getUser($uid);
    
            if (empty($firebaseUser->email)) {
                return response()->json(['error' => 'Email not found in Firebase user.'], 422);
            }
    
            // Step 4: Find or create user in local DB
            $user = User::where('email', $firebaseUser->email)->first();
    
            if (!$user) {
                $user = User::create([
                    'name' => $firebaseUser->displayName ?? $firebaseUser->email,
                    'nick_name' => $firebaseUser->displayName ?? null,
                    'email' => $firebaseUser->email,
                    'password' => Hash::make(str()->random(12)),
                    'status' => 2, // default active
                    'fcm_token' => $fcmToken,
                ]);
            } else {
                // Only update FCM token if provided
                if ($fcmToken) {
                    $user->update(['fcm_token' => $fcmToken]);
                }
            }
    
            // Step 5: Check user status
            if ($user->status != 1) {
                return response()->json([
                    'user' => $user,
                    'error' => 'Your account is inactive. Please contact support.'
                ], 200);
            }
    
            // Step 6: Generate access token
            $token = $user->createToken('auth_token')->plainTextToken;
    
            // Step 7: Sync with Firebase if needed
            $this->syncWithFirebase($user);
    
            // Step 8: Respond with user + token
            return response()->json([
                'message' => 'Login successful',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'nick_name' => $user->nick_name,
                    'status' => $user->status,
                    'fcm_token' => $user->fcm_token,
                    'created_at' => $user->created_at,
                ]
            ], 200);
    
        } catch (UserNotFound $e) {
            return response()->json(['error' => 'Firebase user not found.'], 404);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Unexpected server error.'], 500);
        }
    }
    
    protected function syncWithFirebase($user)
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
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            $auth->createUser([
                'uid' => (string) $user->id,
                'email' => $user->email,
                'displayName' => $user->name,
                'password' => 'Default@123', // App handles auth
            ]);
        }
    }
}
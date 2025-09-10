<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserKycInfo;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.user.index'); // Your Blade file with DataTable markup
    }

    public function getData(Request $request)
    {
        $users = User::select(['id', 'name', 'email', 'user_verify', 'freeze_account', 'status'])
            ->orderBy('id', 'DESC'); // 🔥 Latest users on top

        return DataTables::of($users)
            ->addColumn('verify', function ($user) {
                return $user->user_verify
                    ? '<span class="badge badge-success">Active</span>'
                    : '<span class="badge badge-danger">InActive</span>';
            })
            ->addColumn('freeze', function ($user) {
                return $user->freeze_account
                    ? '<span class="badge badge-success">Active</span>'
                    : '<span class="badge badge-danger">InActive</span>';
            })
            ->addColumn('status', function ($user) {
                return $user->status
                    ? '<span class="badge badge-success">Active</span>'
                    : '<span class="badge badge-danger">InActive</span>';
            })
            ->addColumn('action', function ($user) {
                return view('backend.user.actions', compact('user'))->render();
            })
            ->rawColumns(['verify', 'freeze', 'status', 'action'])
            ->make(true);
    }

    public function view(Request $request)
    {
        $users = User::latest()->get();
        return view('backend.user.list', compact('users'));
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Page Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function add()
    {
        return view('backend.user.add');
    }

    public function store(Request $request)
    {
        try {
            // Debug: Log all request data
            Log::info('User store request data:', $request->all());
            
            $request->validate([
                'name' => 'required|string|max:255',
                'nick_name' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'country' => 'nullable|string|max:255',
                'id_type' => 'nullable|string|max:255',
                'dob' => 'nullable|date_format:d/m/Y',
                'thambnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'thambnail_kyc' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // -----------------------
            // 1. Handle User Insert
            // -----------------------
            $thumb_url = null;
            if ($request->hasFile('thambnail')) {
                $thumb_url = $request->file('thambnail')->store('profile_photos', 'public');
            }

            $user = User::create([
                'name' => $request->name,
                'nick_name' => $request->nick_name,
                'email' => $request->email,
                'profile_photo_path' => $thumb_url,
                'password' => Hash::make($request->password),
                'status' => 2,
            ]);
            
            Log::info('User created successfully:', ['user_id' => $user->id]);

            // -----------------------
            // 2. Handle KYC Info
            // -----------------------
            $kycData = [
                'user_id' => $user->id,
                'country' => $request->country,
                'id_type' => $request->id_type,
            ];

            if ($request->hasFile('thambnail_kyc')) {
                $kycData['id_document'] = $request->file('thambnail_kyc')->store('id_documents', 'public');
            }

            UserKycInfo::create($kycData);
            Log::info('KYC info created successfully for user:', ['user_id' => $user->id]);

            // -----------------------
            // 3. Handle Profile Info
            // -----------------------
            $profileData = $request->only([
                'gender', 'about_you', 'height', 'body_type', 'eye_color', 'hair_color',
                'sleeping_habits', 'love_language', 'childrean', 'financial_status',
                'dress_stype', 'pets', 'zodiac_sign', 'vaccinated', 'drinking_habits',
                'smoking_habits', 'eating_habits', 'communication_style', 'workout',
                'education', 'relationship_status', 'religion', 'location','occupation',
                'love_goals', 'looking_in_partner', 'age_range_in_partner_min',
                'age_range_in_partner_max', 'partner_distance_min', 'partner_distance_max',
                'partner_height_min', 'partner_height_max'
            ]);

            if ($request->dob) {
                $profileData['dob'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
            }

            foreach (['language_speak', 'sports', 'entertainment', 'my_interests', 'iam_looking_for', 'iam_seeking','partner_body_type',
                'partner_relationship_status', 'partner_eye_color','partner_hair_color','partner_smoking_habits', 'partner_eating_habits', 'partner_children','partner_occupation', 'partner_education', 'partner_religion',
                'partner_financial_status', 'partner_dress_style', 'partner_vaccinated','partner_drinking_habits' ,'partner_pets', 'partner_sports', 'partner_entertainment'] as $field) {
                $profileData[$field] = is_array($request->$field)
                    ? implode(',', $request->$field)
                    : $request->$field;
            }

            // Handle gallery photo uploads
            for ($i = 1; $i <= 6; $i++) {
                $photoField = 'gallery_photo' . $i;
                if ($request->hasFile($photoField)) {
                    $photoPath = $request->file($photoField)->store('profile_photos', 'public');
                    $profileData[$photoField] = $photoPath;
                }
            }

            $profileData['user_id'] = $user->id;

            UserProfile::create($profileData);
            Log::info('User profile created successfully for user:', ['user_id' => $user->id]);

            // -----------------------
            // 4. Firebase Sync (Optional - can fail without affecting user creation)
            // -----------------------
            try {
                if ($thumb_url) {
                    $firebase = (new \Kreait\Firebase\Factory)
                        ->withServiceAccount(config('firebase.credentials'))
                        ->withDatabaseUri(config('firebase.projects.app.database.url'));

                    $firebase->createDatabase()
                        ->getReference('users/' . $user->id . '/profile_photo_url')
                        ->set(asset('storage/' . $thumb_url));
                }
            } catch (\Throwable $e) {
                Log::error('Failed to sync profile photo to Firebase: ' . $e->getMessage());
            }

            return redirect()->route('all.user')->with([
                'message' => 'User added successfully!',
                'alert-type' => 'success'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error creating user:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return redirect()->back()->withErrors(['error' => 'Error creating user: ' . $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $user = User::find($id);
        $kycDetail = UserKycInfo::where('user_id', $id)->first();
        $profile = UserProfile::where('user_id', $id)->first();
        $selectedSports = [];
        $selectedEntertainment = [];
        $selectedInterests = [];
        $selectedLookingFor = [];
        $selectedSeeking = [];

        if (!empty($profile->sports)) {
            $selectedSports = explode(',', $profile->sports);
        }
        if (!empty($profile->entertainment)) {
            $selectedEntertainment = explode(',', $profile->entertainment);
        }
        if (!empty($profile->my_interests)) {
            $selectedInterests = explode(',', $profile->my_interests);
        }
        if (!empty($profile->iam_looking_for)) {
            $selectedLookingFor = explode(',', $profile->iam_looking_for);
        }
        if (!empty($profile->iam_seeking)) {
            $selectedSeeking = explode(',', $profile->iam_seeking);
        }
        // $kycDetail->country = trim($kycDetail->country);
        // dd(optional($kycDetail));
        return view('backend.user.edit', compact('user', 'kycDetail', 'profile', 'selectedSports', 'selectedEntertainment', 'selectedInterests', 'selectedLookingFor', 'selectedSeeking'));
    }

    // public function update(Request $request)
    // {
    //     dd($request->all());
    //     $id = $request->id;
    //     /*$request->validate([
    //         'category_name_en'=>'required',
    //         'cagegory_icon' =>'required'
    //     ],[
    //         'category_name_en.required' =>'Input Category EN Name',
    //         'cagegory_icon.required' =>'Input Icon Name',
    //     ]);*/
    //     $data = array();
    //     if ($request->hasFile('thambnail')) {
    //         $page = User::where('id', $id)->first();

    //         // Delete old image from storage if it exists
    //         if ($page->profile_photo_path && file_exists(public_path('storage/' . $page->profile_photo_path))) {
    //             @unlink(public_path('storage/' . $page->profile_photo_path));
    //         }

    //         // Store new image in storage/app/public/profile_photos
    //         $path = $request->file('thambnail')->store('profile_photos', 'public');

    //         // Save relative path for access via asset('storage/'.$path)
    //         $data['profile_photo_path'] = $path;
    //     }

    //     $data['name'] = $request->name;
    //     $data['nick_name'] = $request->nick_name;
    //     $data['email'] = $request->email;

    //     // dd($data) ;

    //     User::findOrFail($id)->update($data);
    //     $notification = array(
    //         'message' => 'User update successfully',
    //         'alert-type' => 'success'
    //     );

    //     try {
    //         $firebase = (new \Kreait\Firebase\Factory)
    //             ->withServiceAccount(config('firebase.credentials'))
    //             ->withDatabaseUri(config('firebase.projects.app.database.url'));

    //         $database = $firebase->createDatabase();

    //         $database
    //             ->getReference('users/' . $id . '/profile_photo_url')
    //             ->set(asset('storage/' . $path));
    //     } catch (\Throwable $e) {
    //         \Log::error('Failed to sync profile photo to Firebase: ' . $e->getMessage());
    //     }

    //     return redirect()->route('all.user')->with($notification);
    // }

    public function update(Request $request)
    {
        $id = $request->id;


        $request->validate([
            'name' => 'required|string|max:255',
            'nick_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'country' => 'nullable|string|max:255',
            'id_type' => 'nullable|string|max:255',
            'dob' => 'nullable|date_format:d/m/Y',
            'thambnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thambnail_kyc' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Add other gallery photos if needed:
            //'gallery_photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'gallery_photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // etc...
        ]);
        // --------------------
        // 1. Handle User Update
        // --------------------
        $data = [];

        if ($request->hasFile('thambnail')) {
            $user = User::findOrFail($id);

            // Delete old image if it exists
            if ($user->profile_photo_path && file_exists(public_path('storage/' . $user->profile_photo_path))) {
                @unlink(public_path('storage/' . $user->profile_photo_path));
            }

            // Store new image in storage/app/public/profile_photos
            $path = $request->file('thambnail')->store('profile_photos', 'public');

            // Save relative path for access via asset('storage/'.$path)
            $data['profile_photo_path'] = $path;
        }

        $data['name'] = $request->name;
        $data['nick_name'] = $request->nick_name;
        $data['email'] = $request->email;

        User::findOrFail($id)->update($data);

        // -----------------------
        // 2. Handle KYC Info Update
        // -----------------------
        $kycData = [
            'user_id' => $id,
            'country' => $request->country,
            'id_type' => $request->id_type,
        ];

        if ($request->hasFile('thambnail_kyc')) {
            $kycPath = $request->file('thambnail_kyc')->store('id_documents', 'public');
            $kycData['id_document'] = $kycPath;
        }

        // if ($request->hasFile('user_photo')) {
        //     $userPhotoPath = $request->file('user_photo')->store('user_photos', 'public');
        //     $kycData['user_photo'] = $userPhotoPath;
        // }

        UserKycInfo::updateOrCreate(['user_id' => $id], $kycData);

        // -----------------------
        // 3. Handle Profile Info Update
        // -----------------------
        $profileData = $request->only([
            'gender', 'about_you', 'height', 'body_type', 'eye_color', 'hair_color',
            'sleeping_habits', 'love_language', 'childrean', 'financial_status',
            'dress_stype', 'pets', 'zodiac_sign', 'vaccinated', 'drinking_habits',
            'smoking_habits', 'eating_habits', 'communication_style', 'workout',
            'education', 'relationship_status', 'religion', 'location','occupation',
            'love_goals', 'looking_in_partner', 'age_range_in_partner_min',
            'age_range_in_partner_max', 'partner_distance_min', 'partner_distance_max',
            'partner_height_min', 'partner_height_max'
        ]);

        if ($request->dob) {
            $profileData['dob'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        }

        $arrayFields = [
            'language_speak', 'sports', 'entertainment', 'my_interests', 'iam_looking_for',
            'iam_seeking','partner_body_type',
            'partner_relationship_status', 'partner_eye_color', 'partner_hair_color',
            'partner_smoking_habits', 'partner_eating_habits', 'partner_children',
            'partner_occupation', 'partner_education', 'partner_religion',
            'partner_financial_status', 'partner_dress_style', 'partner_vaccinated','partner_drinking_habits', 'partner_pets', 'partner_sports', 'partner_entertainment'
        ];

        foreach ($arrayFields as $field) {
            $profileData[$field] = is_array($request->$field)
                ? implode(',', $request->$field)
                : $request->$field;
        }

        // Handle gallery photo uploads
        for ($i = 1; $i <= 6; $i++) {
            $photoField = 'gallery_photo' . $i;
            if ($request->hasFile($photoField)) {
                $photoPath = $request->file($photoField)->store('profile_photos', 'public');
                $profileData[$photoField] = $photoPath;
            }
        }

        $profileData['user_id'] = $id;

        UserProfile::updateOrCreate(['user_id' => $id], $profileData);

        // ------------------
        // 4. Firebase Sync
        // ------------------
        try {
            if (!empty($path)) {
                $firebase = (new \Kreait\Firebase\Factory)
                    ->withServiceAccount(config('firebase.credentials'))
                    ->withDatabaseUri(config('firebase.projects.app.database.url'));

                $database = $firebase->createDatabase();

                $database
                    ->getReference('users/' . $id . '/profile_photo_url')
                    ->set(asset('storage/' . $path));
            }
        } catch (\Throwable $e) {
            Log::error('Firebase sync failed: ' . $e->getMessage());
        }

        return redirect()->route('all.user')->with([
            'message' => 'User updated successfully!',
            'alert-type' => 'success'
        ]);
    }

    public function toggleVerify($id)
    {
        $user = User::findOrFail($id);
        $user->user_verify = !$user->user_verify;
        $user->save();

        return back()->with('message', 'Verification status updated');
    }

    public function toggleFreeze($id)
    {
        $user = User::findOrFail($id);
        $user->freeze_account = !$user->freeze_account;
        $user->save();

        return back()->with('message', 'Freeze status updated');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();

        return back()->with('message', 'Account status updated');
    }


}

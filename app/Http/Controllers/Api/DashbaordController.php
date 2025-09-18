<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAction;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use App\Services\FirebaseService;
use Kreait\Firebase\Factory;

class DashbaordController extends Controller
{
    use ApiResponse;
    public function __construct(protected FirebaseService $firebase)
    {
        $this->firebaseservice = $firebase;
    }

    public function users(Request $request)
    {
        //dd($request->all());
        $currentUserId = auth()->id();

        $currentUser = User::with('profile')->findOrFail($currentUserId);
        $currentProfile = $currentUser->profile;
        //$blockedIds = auth()->user()->blocks()->pluck('blocked_user_id');
        //$age = $currentProfile->dob ? Carbon::parse($currentProfile->dob)->age : null;

        // Get current user's location
        $currentLat = $currentProfile->latitude ?? null;
        $currentLng = $currentProfile->longitude ?? null;

        // Default radius in kilometers
        $radiusKm = 50;

        $blockedIds = UserAction::where('user_id', auth()->id())
            ->where('blocked', true)
            ->pluck('target_user_id');

        // $users = User::with('profile')
        //     ->where('status', 1)
        //     ->where('id', '!=', $currentUserId)
        //     ->whereNotIn('id', $blockedIds)
        //     ->latest()
        //     ->get();

        // Extract filters
        $distanceMin = $request->input('partner_distance_min');
        $distanceMax = $request->input('partner_distance_max');
        $heightMin = $request->input('partner_height_min');
        $heightMax = $request->input('partner_height_max');

        $ageMin = $request->input('partner_age_min');
        $ageMax = $request->input('partner_age_max');

        $location = $request->input('location');

        $orderBy = $request->input('order_by', 'new');
        $search = $request->input('search');
        $usersQuery = User::with(['profile', 'kyc', 'actionByCurrentUser'])  //
            ->where('status', 1)
            ->where('freeze_account', false)
            ->where('id', '!=', $currentUserId)
            ->whereNotIn('id', $blockedIds)
            ->whereHas('profile', function ($q) use ($heightMin, $heightMax, $ageMin, $ageMax, $currentProfile, $currentLat, $currentLng, $radiusKm) {
                if ($heightMin !== null && $heightMax !== null) {
                    $q->whereBetween('height', [$heightMin, $heightMax]);
                }

                if ($ageMin !== null && $ageMax !== null) {
                    $q->whereRaw('TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN ? AND ?', [(int)$ageMin, (int)$ageMax]);
                }

                // Add distance filter if current user has location
                if ($currentLat !== null && $currentLng !== null) {
                    $q->whereRaw("
                        (6371 * acos(
                            cos(radians(?)) *
                            cos(radians(latitude)) *
                            cos(radians(longitude) - radians(?)) +
                            sin(radians(?)) *
                            sin(radians(latitude))
                        )) <= ?
                    ", [$currentLat, $currentLng, $currentLat, $radiusKm]);
                }

                //dd($currentProfile->iam_seeking);
                if (!empty($currentProfile->iam_seeking)) {
                    $rawGenders = array_map('trim', explode(',', $currentProfile->iam_seeking));

                    if (!in_array('Couple', $rawGenders) && !in_array('No Preference', array_map('strtolower', $rawGenders))) {
                        $genderMap = [
                            'Man' => 'Male',
                            'Woman' => 'Female'
                        ];
                        $mappedGenders = array_filter(array_map(function ($g) use ($genderMap) {
                            return $genderMap[$g] ?? null;
                        }, $rawGenders));

                        if (!empty($mappedGenders)) {
                            $q->whereIn('gender', $mappedGenders);
                        }
                    }
                }






                /*
            // Desired partner filters from current profile
            if (!empty($currentProfile->partner_body_type)) {
                $q->where('body_type', $currentProfile->partner_body_type);
            }

            if (!empty($currentProfile->partner_eye_color)) {
                $q->where('eye_color', $currentProfile->partner_eye_color);
            }

            if (!empty($currentProfile->partner_hair_color)) {
                $q->where('hair_color', $currentProfile->partner_hair_color);
            }

            if (!empty($currentProfile->partner_smoking_habits)) {
                $q->where('smoking_habits', $currentProfile->partner_smoking_habits);
            }

            if (!empty($currentProfile->partner_dress_style)) {
                $q->where('dress_stype', $currentProfile->partner_dress_style);
            }

            if (!empty($currentProfile->partner_financial_status)) {
                $q->where('financial_status', $currentProfile->partner_financial_status);
            }

            if (!empty($currentProfile->partner_religion)) {
                $q->where('religion', $currentProfile->partner_religion);
            }

            if (!empty($currentProfile->partner_vaccinated)) {
                $q->where('vaccinated', $currentProfile->partner_vaccinated);
            }

            if (!empty($currentProfile->partner_pets)) {
                $q->where('pets', $currentProfile->partner_pets);
            }

            // Sports match (partial string match)
            if (!empty($currentProfile->partner_sports)) {
                $sports = explode(',', strtolower($currentProfile->partner_sports));
                $q->where(function ($sq) use ($sports) {
                    foreach ($sports as $sport) {
                        $sq->orWhereRaw('LOWER(sports) LIKE ?', ['%' . trim($sport) . '%']);
                    }
                });
            }

            // Entertainment match (optional)
            if (!empty($currentProfile->partner_entertainment)) {
                $entertainments = explode(',', strtolower($currentProfile->partner_entertainment));
                $q->where(function ($sq) use ($entertainments) {
                    foreach ($entertainments as $ent) {
                        $sq->orWhereRaw('LOWER(entertainment) LIKE ?', ['%' . trim($ent) . '%']);
                    }
                });
            }

            */
            })
            ->whereHas('kyc', function ($q) use ($location) {
                if (!empty($location)) {
                    $q->where('location', 'like', '%' . $location . '%');
                }
            });

        if (!empty($search)) {
            $usersQuery->where('name', 'like', '%' . $search . '%');
        }

        // Order by newest or oldest
        if ($orderBy === 'newest') {
            $usersQuery->orderBy('id', 'desc');
        } elseif ($orderBy === 'oldest') {
            $usersQuery->orderBy('id', 'asc');
        } else {
            $usersQuery->orderBy('id', 'asc'); // default
        }

        $users = $usersQuery->get();



        $usersFormatted = $users->map(function ($user) use ($currentProfile, $currentLat, $currentLng) {
            $profile = $user->profile;

            if (!$profile) return null;

            $age = $profile->dob ? Carbon::parse($profile->dob)->age : null;
            $matchScore = 0;
            $totalCriteria = 10;

            // Matching logic
            if ($currentProfile->partner_body_type === $profile->body_type) $matchScore++;
            if ($currentProfile->partner_eye_color === $profile->eye_color) $matchScore++;
            if ($currentProfile->partner_hair_color === $profile->hair_color) $matchScore++;
            if ($currentProfile->partner_smoking_habits === $profile->smoking_habits) $matchScore++;
            if ($currentProfile->partner_dress_style === $profile->dress_stype) $matchScore++;
            if ($currentProfile->partner_financial_status === $profile->financial_status) $matchScore++;
            if ($currentProfile->partner_religion === $profile->religion) $matchScore++;
            if ($currentProfile->partner_vaccinated === $profile->vaccinated) $matchScore++;
            if ($currentProfile->partner_pets === $profile->pets) $matchScore++;

            // Sports & Entertainment match (partial)
            $userSports = explode(',', strtolower($profile->sports));
            $preferredSports = explode(',', strtolower($currentProfile->partner_sports));
            $intersectSports = array_intersect($userSports, $preferredSports);
            if (count($intersectSports)) $matchScore++;

            $matchPercentage = round(($matchScore / $totalCriteria) * 100);

            // Calculate actual distance if both users have location
            $distance = 'Location not available';
            if ($currentLat && $currentLng && $profile->latitude && $profile->longitude) {
                $earthRadius = 6371; // Earth's radius in kilometers

                $dLat = deg2rad($profile->latitude - $currentLat);
                $dLng = deg2rad($profile->longitude - $currentLng);

                $a = sin($dLat/2) * sin($dLat/2) +
                     cos(deg2rad($currentLat)) * cos(deg2rad($profile->latitude)) *
                     sin($dLng/2) * sin($dLng/2);
                $c = 2 * atan2(sqrt($a), sqrt(1-$a));

                $distanceKm = round($earthRadius * $c, 1);
                $distance = $distanceKm . ' km away';
            }

            $action = $user->actionByCurrentUser;

            $actionStatus = [
                'liked' => $action?->liked ?? false,
                'superliked' => $action?->superliked ?? false,
                'blocked' => $action?->blocked ?? false,
                'save' => $action?->save ?? false,
                'dateAdminers' => $action?->dateAdminers ?? false,
                'dateinvite' => $action?->dateinvite ?? false,
            ];


            return [
                'id' => $user->id,
                'name' => $user->name,
                'nick_name' => $user->nick_name,
                'age' => $age,
                'height' => $profile->height,
                'gender' => $profile->gender,
                'email' => $user->email,
                'distance' => $distance,
                'profile_photo_url' => $user->profile_photo_path
                    ? asset('storage/' . $user->profile_photo_path)
                    : null,
                'match_percentage' => $matchPercentage,
                'user_verify' => $user->user_verify,
                'action' => $actionStatus,
            ];
        })->filter(); // Remove nulls

        return $this->success('Users fetched successfully', [
            'users' => $usersFormatted
        ]);
    }


    public function users_list(Request $request, $id = null)
    {
        try {
            $currentUserId = auth()->id();
            $currentUser = User::with('profile')->findOrFail($currentUserId);
            $currentProfile = $currentUser->profile;

            // Helper to calculate match percentage
            $calculateMatch = function ($profile) use ($currentProfile) {
                $matchScore = 0;
                $totalCriteria = 10;

                if ($currentProfile->partner_body_type === $profile->body_type) $matchScore++;
                if ($currentProfile->partner_eye_color === $profile->eye_color) $matchScore++;
                if ($currentProfile->partner_hair_color === $profile->hair_color) $matchScore++;
                if ($currentProfile->partner_smoking_habits === $profile->smoking_habits) $matchScore++;
                if ($currentProfile->partner_dress_style === $profile->dress_stype) $matchScore++;
                if ($currentProfile->partner_financial_status === $profile->financial_status) $matchScore++;
                if ($currentProfile->partner_religion === $profile->religion) $matchScore++;
                if ($currentProfile->partner_vaccinated === $profile->vaccinated) $matchScore++;
                if ($currentProfile->partner_pets === $profile->pets) $matchScore++;

                // Sports matching
                $userSports = explode(',', strtolower($profile->sports));
                $preferredSports = explode(',', strtolower($currentProfile->partner_sports));
                $intersectSports = array_intersect($userSports, $preferredSports);
                if (count($intersectSports)) $matchScore++;

                return round(($matchScore / $totalCriteria) * 100);
            };

            // Format photo URLs
            $formatGalleryPhotos = function ($profile) {
                $url = fn($path) => $path ? asset('storage/' . $path) : null;
                $profile->profile_photo_url = $url($profile->profile_photo);
                $profile->gallery_photo1_url = $url($profile->gallery_photo1);
                $profile->gallery_photo2_url = $url($profile->gallery_photo2);
                $profile->gallery_photo3_url = $url($profile->gallery_photo3);
                $profile->gallery_photo4_url = $url($profile->gallery_photo4);
                $profile->gallery_photo5_url = $url($profile->gallery_photo5);
                $profile->gallery_photo6_url = $url($profile->gallery_photo6);
                return $profile;
            };

            if ($id) {
                $user = User::with('profile', 'kyc', 'actionFromCurrentUser')->find($id);

                if (!$user) {
                    return $this->error('User not found', [], 404);
                }

                $profile = $user->profile;
                if (!$profile) {
                    return $this->error('User profile not found', [], 404);
                }

                $profile = $formatGalleryPhotos($profile);
                $age = $profile->dob ? Carbon::parse($profile->dob)->age : null;
                $matchPercentage = $calculateMatch($profile);
                $actionStatus = [
                    'liked' => $user->actionFromCurrentUser?->liked ?? false,
                    'superliked' => $user->actionFromCurrentUser?->superliked ?? false,
                    'blocked' => $user->actionFromCurrentUser?->blocked ?? false,
                    'save' => $user->actionFromCurrentUser?->save ?? false,
                    'dateAdminers' => $user->actionFromCurrentUser?->dateAdminers ?? false,
                    'dateinvite' => $user->actionFromCurrentUser?->dateinvite ?? false,
                ];
                $userFormatted = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'nick_name' => $user->nick_name,
                    'age' => $age,
                    'height' => $profile->height,
                    'email' => $user->email,
                    'gender' => $profile->gender,
                    'distance' => '1 km away',
                    'profile_photo_url' => $user->profile_photo_path
                        ? asset('storage/' . $user->profile_photo_path)
                        : null,
                    'match_percentage' => $matchPercentage,
                    'user_verify' => $user->user_verify,
                    'profile' => $profile,
                    'kyc' => $user->kyc,
                    'action_from_current_user' => $user->actionFromCurrentUser ? $user->actionFromCurrentUser->only(['liked', 'superliked', 'blocked', 'save', 'dateinvite', 'dateAdminers']) : null,
                ];

                return $this->success('User fetched successfully', ['user' => $userFormatted]);
            } else {

                $genderMap = [
                    'Man' => 'Male',
                    'Woman' => 'Female'
                ];
                // Exclude users that current user has interacted with
                $excludedIds = UserAction::where('user_id', $currentUserId)
                    ->where(function ($query) {
                        $query->where('liked', true)
                            ->orWhere('superliked', true)
                            ->orWhere('blocked', true);
                    })
                    ->pluck('target_user_id')
                    ->toArray();

                $excludedIds[] = $currentUserId;

                $user = User::with(['profile', 'actionByCurrentUser'])
                    ->where('status', 1)
                    ->whereNotIn('id', $excludedIds)
                    ->whereHas('profile', function ($q) use ($currentProfile, $genderMap) {
                        if (!empty($currentProfile->iam_seeking)) {
                            $rawGenders = array_map('trim', explode(',', $currentProfile->iam_seeking));
                            $lowerRaw = array_map('strtolower', $rawGenders);

                            // Skip gender filter if 'couple' or 'no preference' is selected
                            if (!in_array('couple', $lowerRaw) && !in_array('no preference', $lowerRaw)) {
                                $mappedGenders = array_filter(array_map(function ($g) use ($genderMap) {
                                    return $genderMap[$g] ?? null;
                                }, $rawGenders));

                                if (!empty($mappedGenders)) {
                                    $q->whereIn('gender', $mappedGenders);
                                }
                            }
                            // else: don't apply gender filter (show all genders)
                        }
                    })
                    ->latest()
                    ->first();

                // ⚠️ Null check for $user
                if (!$user || !$user->profile) {
                    return $this->error('No matching users found', [], 404);
                }

                $profile = $formatGalleryPhotos($user->profile);
                $age = $profile->dob ? Carbon::parse($profile->dob)->age : null;
                $matchPercentage = $calculateMatch($profile);

                $actionStatus = [
                    'liked' => $user->actionByCurrentUser?->liked ?? false,
                    'superliked' => $user->actionByCurrentUser?->superliked ?? false,
                    'blocked' => $user->actionByCurrentUser?->blocked ?? false,
                    'save' => $user->actionByCurrentUser?->save ?? false,
                    'dateAdminers' => $user->actionByCurrentUser?->dateAdminers ?? false,
                    'dateinvite' => $user->actionByCurrentUser?->dateinvite ?? false,
                ];

                $userFormatted = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'nick_name' => $user->nick_name,
                    'age' => $age,
                    'height' => $profile->height,
                    'gender' => $profile->gender,
                    'email' => $user->email,
                    'distance' => '1 km away',
                    'profile_photo_url' => $user->profile_photo_path
                        ? asset('storage/' . $user->profile_photo_path)
                        : null,
                    'match_percentage' => $matchPercentage,
                    'user_verify' => $user->user_verify,
                    'profile' => $profile,
                    'action' => $actionStatus,
                ];

                return $this->success('User fetched successfully', ['user' => $userFormatted]);
            }
        } catch (ModelNotFoundException $e) {
            return $this->error('User not found', [], 404);
        } catch (Exception $e) {
            return $this->error('An unexpected error occurred', ['error' => $e->getMessage()], 500);
        }
    }

    public function userDetails(Request $request, $id)
    {
        $user = User::with('profile', 'kyc')->find($id);

        if (!$user) {
            return $this->error('User not found', [], 404);
        }

        $profile = $user->profile;

        if ($profile) {
            // Helper to generate full URL or null if empty
            $fullUrl = fn($path) => $path ? asset('storage/' . $path) : null;

            // Add full URLs for profile and gallery photos
            $profile->profile_photo_url = $fullUrl($profile->profile_photo);
            $profile->gallery_photo1_url = $fullUrl($profile->gallery_photo1);
            $profile->gallery_photo2_url = $fullUrl($profile->gallery_photo2);
            $profile->gallery_photo3_url = $fullUrl($profile->gallery_photo3);
            $profile->gallery_photo4_url = $fullUrl($profile->gallery_photo4);
            $profile->gallery_photo5_url = $fullUrl($profile->gallery_photo5);
            $profile->gallery_photo6_url = $fullUrl($profile->gallery_photo6);
        }

        return $this->success('User retrieved successfully', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'nick_name' => $user->nick_name,
                'email' => $user->email,
                'distance' => '1 km away',
                'profile' => $profile,
                'kyc' => $user->kyc,
                'profile_photo_url' => asset('storage/' . $user->profile_photo_path)  ?? null,
            ]
        ]);
    }


    public function editUser(Request $request)
    {
        $currentUserId = auth()->id();
        $user = User::with('profile')->find($currentUserId);

        if (!$user) {
            return $this->error('User not found', [], 404);
        }

        $profile = $user->profile;

        if ($profile) {
            // Helper to generate full URL or null if empty
            $fullUrl = fn($path) => $path ? asset('storage/' . $path) : null;

            // Add full URLs for profile and gallery photos
            $profile->profile_photo_url = $fullUrl($profile->profile_photo);
            $profile->gallery_photo1_url = $fullUrl($profile->gallery_photo1);
            $profile->gallery_photo2_url = $fullUrl($profile->gallery_photo2);
            $profile->gallery_photo3_url = $fullUrl($profile->gallery_photo3);
            $profile->gallery_photo4_url = $fullUrl($profile->gallery_photo4);
            $profile->gallery_photo5_url = $fullUrl($profile->gallery_photo5);
            $profile->gallery_photo6_url = $fullUrl($profile->gallery_photo6);
        }

        return $this->success('User retrieved successfully', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'height' => $profile->height,
                'profile' => $profile,
                'profile_photo_url' => $user->profile_photo_url ?? null,
            ]
        ]);
    }

    public function editUpdate(Request $request)
    {
        $currentUserId = auth()->id();
        $user = User::with('profile')->find($currentUserId);

        if (!$user) {
            return $this->error('User not found', [], 404);
        }

        $profile = $user->profile;

        if ($profile) {
            // Helper to generate full URL or null if empty
            $fullUrl = fn($path) => $path ? asset('storage/' . $path) : null;

            // Add full URLs for profile and gallery photos
            $profile->profile_photo_url = $fullUrl($profile->profile_photo);
            $profile->gallery_photo1_url = $fullUrl($profile->gallery_photo1);
            $profile->gallery_photo2_url = $fullUrl($profile->gallery_photo2);
            $profile->gallery_photo3_url = $fullUrl($profile->gallery_photo3);
            $profile->gallery_photo4_url = $fullUrl($profile->gallery_photo4);
            $profile->gallery_photo5_url = $fullUrl($profile->gallery_photo5);
            $profile->gallery_photo6_url = $fullUrl($profile->gallery_photo6);
        }

        return $this->success('User retrieved successfully', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $profile,
                'profile_photo_url' => $profile ? $profile->profile_photo_url : null,
            ]
        ]);
    }
    public function commentUser(Request $request)
    {
        try {
            // Manual validation to ensure JSON response
            $validator = Validator::make($request->all(), [
                'target_user_id' => 'required|exists:users,id',
                'comment' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $validated = $validator->validated();

            // Create comment for authenticated user
            $comment = auth()->user()->comments()->create([
                'target_user_id' => $validated['target_user_id'],
                'comment' => $validated['comment']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully',
                'comment' => $comment
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Target user not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function handleAction(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'target_user_id' => 'required|exists:users,id',
                'action' => 'required|in:like,dislike,superlike,superdislike,save,unsave,block,unblock,dateinvite,dateAdminers,unDateAdminers',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $validated = $validator->validated();
            $userId = auth()->id();
            $targetId = $validated['target_user_id'];
            $action = $validated['action'];

            $data = [
                'user_id' => $userId,
                'target_user_id' => $targetId,
            ];

            // Map each action to a field and value
            $fieldMap = [
                'like' => ['field' => 'liked', 'value' => 1],
                'dislike' => ['field' => 'liked', 'value' => 0],
                'superlike' => ['field' => 'superliked', 'value' => 1],
                'superdislike' => ['field' => 'superliked', 'value' => 0],
                'save' => ['field' => 'save', 'value' => 1],
                'unsave' => ['field' => 'save', 'value' => 0],
                'block' => ['field' => 'blocked', 'value' => 1],
                'unblock' => ['field' => 'blocked', 'value' => 0],
                'dateinvite' => ['field' => 'dateinvite', 'value' => 1],
                'dateAdminers' => ['field' => 'dateAdminers', 'value' => 1],
                'unDateAdminers' => ['field' => 'dateAdminers', 'value' => 0],
            ];

            $field = $fieldMap[$action]['field'];
            $newValue = $fieldMap[$action]['value'];

            // List of all action fields
            $allActionFields = ['liked', 'superliked', 'save', 'blocked', 'dateinvite', 'dateAdminers'];

            $existingAction = UserAction::where($data)->first();

            // Allow changing actions, but prevent duplicate actions of the same type
            if ($existingAction) {
                // Check if user is trying to perform the same action again
                if ($existingAction->$field === $newValue) {
                    return response()->json([
                        'success' => false,
                        'message' => "You have already performed this action on this user.",
                    ], 200);
                }
            }

            // Reset all action fields and apply the new one
            $updates = array_fill_keys($allActionFields, null);
            $updates[$field] = $newValue;

            $userAction = UserAction::updateOrCreate($data, $updates);

            // Send notification if FCM token exists
            $targetUser = User::findOrFail($targetId);
            if ($targetUser->fcm_token) {
                $this->firebaseservice->sendPushNotification(
                    $targetUser->fcm_token,
                    'You have a new ' . ucfirst($action),
                    auth()->user()->name . " has {$action} you.",
                    [
                        'type' => $action,
                        'from_user_id' => $userId,
                    ]
                );

                try {
                    $firebase = (new Factory)
                        ->withServiceAccount(config('firebase.credentials'))
                        ->withDatabaseUri(config('firebase.projects.app.database.url'));

                    $database = $firebase->createDatabase();

                    $database->getReference('notifications/' . $targetUser->id)->push([
                        'isRead' => false,
                        'receiverId' => (string)$targetUser->id,
                        'senderId' => (string)$userId,
                        'timestamp' => Carbon::now()->timestamp * 1000,
                        'title' => auth()->user()->name . ' ' . $this->getNotificationText($action),
                        'type' => $action,
                    ]);
                } catch (Exception $e) {
                    Log::error("Firebase DB write failed: " . $e->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => ucfirst($action) . ' action recorded successfully.',
                'data' => $userAction
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Target user not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




    public function handleAction_old(Request $request)
    {
        try {
            // Manual validation to ensure JSON response even without Accept: application/json header
            $validator = Validator::make($request->all(), [
                'target_user_id' => 'required|exists:users,id',
                'action' => 'required|in:like,dislike,superlike,block,unblock,superdislike,save,dateinvite,dateAdminers',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $validated = $validator->validated();

            $userId = auth()->id();
            $targetId = $validated['target_user_id'];
            $action = $validated['action'];

            $data = [
                'user_id' => $userId,
                'target_user_id' => $targetId,
            ];

            // Reset all fields to null before updating based on action
            $updates = [
                'liked' => null,
                'superliked' => null,
                'save' => null,
                'blocked' => null,
                'dateAdminers' => null,
                'dateinvite' => null,
            ];

            // Set the proper field based on the action
            switch ($action) {
                case 'like':
                    $updates['liked'] = true;
                    break;
                case 'dislike':
                    $updates['liked'] = false;
                    break;
                case 'superlike':
                    $updates['superliked'] = true;
                    break;
                case 'superdislike':
                    $updates['superliked'] = false;
                    break;
                case 'save':
                    $updates['save'] = true;
                    break;
                case 'unsave':
                    $updates['save'] = false;
                    break;
                case 'dateAdminers':
                    $updates['dateAdminers'] = true;
                    break;
                case 'unDateAdminers':
                    $updates['dateAdminers'] = false;
                    break;
                case 'block':
                    $updates['blocked'] = true;
                    break;
                case 'unblock':
                    $updates['blocked'] = false;
                    break;
                case 'dateinvite':
                    $updates['dateinvite'] = true;
                    break;
            }

            // Update or create the user action record
            $userAction = UserAction::updateOrCreate($data, $updates);

            // ✅ Fetch the target user here
            $targetUser = User::findOrFail($targetId);
            //$targetUser = User::findOrFail($userId);

            if ($targetUser->fcm_token) {
                $this->firebaseservice->sendPushNotification(
                    $targetUser->fcm_token,
                    'You have a new ' . ucfirst($action),
                    auth()->user()->name . " has {$action} you.",
                    [
                        'type' => $action,
                        'from_user_id' => auth()->id(),
                    ]
                );
                // 7. Save notification in Firebase Realtime Database
                try {
                    $firebase = (new Factory)
                        ->withServiceAccount(config('firebase.credentials'))
                        ->withDatabaseUri(config('firebase.projects.app.database.url'));

                    $database = $firebase->createDatabase();

                    $receiverId = (string)$targetUser->id;
                    $senderId = (string)auth()->id();

                    $database->getReference('notifications/' . $receiverId)->push([
                        'isRead' => false,
                        'receiverId' => $receiverId,
                        'senderId' => $senderId,
                        'timestamp' => Carbon::now()->timestamp * 1000,
                        'title' => auth()->user()->name . ' ' . $this->getNotificationText($action),
                        'type' => $action,
                    ]);
                } catch (Exception $e) {
                    Log::error("Failed to write notification to Firebase: " . $e->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => ucfirst($action) . ' action recorded successfully.',
                'data' => $userAction
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Target user not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function convertDateinviteToAdminers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'target_user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $userId = auth()->id();
        $targetId = $request->target_user_id;

        $userAction = UserAction::where('user_id', $targetId)
            ->where('target_user_id', (int)$userId)
            ->first();
        //dd($userId);
        if (!$userAction) {
            return response()->json([
                'success' => false,
                'message' => 'User action not found.',
            ], 404);
        }

        // Only convert if dateinvite is true
        if ($userAction->dateinvite) {
            $userAction->update([
                'dateinvite' => false,
                'dateAdminers' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No active dateinvite found for this user pair.',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'dateinvite converted to dateAdminers successfully.',
            'data' => $userAction
        ]);
    }

    public function getActions(Request $request)
    {
        $allowedTypes = ['liked', 'superliked', 'save', 'blocked', 'dateAdminers', 'your-matches', 'dateinvite'];
        $type = $request->query('type');

        if (!in_array($type, $allowedTypes)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid action type',
                'allowed_types' => $allowedTypes,
            ], 422);
        }

        $currentUserId = auth()->id();
        $currentUser = User::with('profile')->findOrFail($currentUserId);
        $currentProfile = $currentUser->profile;

        // Match percentage calculator
        $calculateMatch = function ($profile) use ($currentProfile) {
            $matchScore = 0;
            $totalCriteria = 10;

            if ($currentProfile->partner_body_type === $profile->body_type) $matchScore++;
            if ($currentProfile->partner_eye_color === $profile->eye_color) $matchScore++;
            if ($currentProfile->partner_hair_color === $profile->hair_color) $matchScore++;
            if ($currentProfile->partner_smoking_habits === $profile->smoking_habits) $matchScore++;
            if ($currentProfile->partner_dress_style === $profile->dress_stype) $matchScore++;
            if ($currentProfile->partner_financial_status === $profile->financial_status) $matchScore++;
            if ($currentProfile->partner_religion === $profile->religion) $matchScore++;
            if ($currentProfile->partner_vaccinated === $profile->vaccinated) $matchScore++;
            if ($currentProfile->partner_pets === $profile->pets) $matchScore++;

            $userSports = explode(',', strtolower($profile->sports));
            $preferredSports = explode(',', strtolower($currentProfile->partner_sports));
            $intersectSports = array_intersect($userSports, $preferredSports);
            if (count($intersectSports)) $matchScore++;

            return round(($matchScore / $totalCriteria) * 100);
        };

        // Handle "your-matches" type separately
        if ($type === 'your-matches') {
            // 1. Get all users current user liked or superliked
            $myLikes = UserAction::where('user_id', $currentUserId)
                ->where(function ($q) {
                    $q->where('liked', true)->orWhere('superliked', true);
                })
                ->pluck('target_user_id');

            // 2. Find mutuals
            $mutuals = UserAction::whereIn('user_id', $myLikes)
                ->where('target_user_id', $currentUserId)
                ->where(function ($q) {
                    $q->where('liked', true)->orWhere('superliked', true);
                })
                ->with(['user.profile']) // `user` is the one who matched back
                ->get();

            $usersFormatted = $mutuals->map(function ($action) use ($calculateMatch) {
                $user = $action->user;
                $profile = $user->profile;

                if (!$profile) return null;

                $age = $profile->dob ? \Carbon\Carbon::parse($profile->dob)->age : null;
                $matchPercentage = $calculateMatch($profile);

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'age' => $age,
                    'height' => $profile->height,
                    'email' => $user->email,
                    'gender' => $profile->gender,
                    'distance' => '1 km away',
                    'profile_photo_url' => $user->profile_photo_path
                        ? asset('storage/' . $user->profile_photo_path)
                        : null,
                    'match_percentage' => $matchPercentage,
                    'user_verify' => $user->user_verify,
                ];
            })->filter();

            return $this->success('Your matches fetched successfully', [
                'users' => $usersFormatted->values()
            ]);
        }

        // Default action types (liked, superliked, etc.)
        $actions = UserAction::where('user_id', $currentUserId)
            ->where($type, true)
            ->with(['targetUser.profile'])
            ->get();

        $usersFormatted = $actions->map(function ($action) use ($calculateMatch) {

            $user = $action->targetUser;
            $profile = $user->profile ?? '';

            if (!$profile) return null;

            $age = $profile->dob ? \Carbon\Carbon::parse($profile->dob)->age : null;
            $matchPercentage = $calculateMatch($profile);

            return [
                'id' => $user->id,
                'name' => $user->name,
                'age' => $age,
                'height' => $profile->height ?? '',
                'email' => $user->email,
                'distance' => '1 km away',
                'profile_photo_url' => $user->profile_photo_path
                    ? asset('storage/' . $user->profile_photo_path)
                    : null,
                'match_percentage' => $matchPercentage,
                'user_verify' => $user->user_verify,
            ];
        })->filter();

        return $this->success('Users fetched successfully', [
            'users' => $usersFormatted->values()
        ]);
    }
    public function getActionsTrageted(Request $request)
    {
        $allowedTypes = ['liked', 'superliked', 'save', 'blocked', 'dateAdminers', 'your-matches'];
        $type = $request->query('type');

        if (!in_array($type, $allowedTypes)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid action type',
                'allowed_types' => $allowedTypes,
            ], 422);
        }

        $currentUserId = auth()->id();
        $currentUser = User::with('profile')->findOrFail($currentUserId);
        $currentProfile = $currentUser->profile;

        // Match percentage calculator
        $calculateMatch = function ($profile) use ($currentProfile) {
            $matchScore = 0;
            $totalCriteria = 10;

            if ($currentProfile->partner_body_type === $profile->body_type) $matchScore++;
            if ($currentProfile->partner_eye_color === $profile->eye_color) $matchScore++;
            if ($currentProfile->partner_hair_color === $profile->hair_color) $matchScore++;
            if ($currentProfile->partner_smoking_habits === $profile->smoking_habits) $matchScore++;
            if ($currentProfile->partner_dress_style === $profile->dress_stype) $matchScore++;
            if ($currentProfile->partner_financial_status === $profile->financial_status) $matchScore++;
            if ($currentProfile->partner_religion === $profile->religion) $matchScore++;
            if ($currentProfile->partner_vaccinated === $profile->vaccinated) $matchScore++;
            if ($currentProfile->partner_pets === $profile->pets) $matchScore++;

            $userSports = explode(',', strtolower($profile->sports));
            $preferredSports = explode(',', strtolower($currentProfile->partner_sports));
            $intersectSports = array_intersect($userSports, $preferredSports);
            if (count($intersectSports)) $matchScore++;

            return round(($matchScore / $totalCriteria) * 100);
        };

        // Handle "your-matches" type separately
        if ($type === 'your-matches') {
            // 1. Get all users current user liked or superliked
            $myLikes = UserAction::where('user_id', $currentUserId)
                ->where(function ($q) {
                    $q->where('liked', true)->orWhere('superliked', true);
                })
                ->pluck('target_user_id');

            // 2. Find mutuals
            $mutuals = UserAction::whereIn('user_id', $myLikes)
                ->where('target_user_id', $currentUserId)
                ->where(function ($q) {
                    $q->where('liked', true)->orWhere('superliked', true);
                })
                ->with(['user.profile']) // `user` is the one who matched back
                ->get();

            $usersFormatted = $mutuals->map(function ($action) use ($calculateMatch) {
                $user = $action->user;
                $profile = $user->profile;

                if (!$profile) return null;

                $age = $profile->dob ? \Carbon\Carbon::parse($profile->dob)->age : null;
                $matchPercentage = $calculateMatch($profile);

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'age' => $age,
                    'height' => $profile->height,
                    'gender' => $profile->gender,
                    'email' => $user->email,
                    'distance' => '1 km away',
                    'profile_photo_url' => $user->profile_photo_path
                        ? asset('storage/' . $user->profile_photo_path)
                        : null,
                    'match_percentage' => $matchPercentage,
                    'user_verify' => $user->user_verify,
                ];
            })->filter();

            return $this->success('Your matches fetched successfully', [
                'users' => $usersFormatted->values()
            ]);
        }

        // Default action types (liked, superliked, etc.)
        $actions = UserAction::where('target_user_id', $currentUserId)
            ->where($type, 1)
            ->with(['user.profile'])
            ->get();

        $usersFormatted = $actions->map(function ($action) use ($calculateMatch) {

            $user = $action->user;
            $profile = $user->profile ?? '';

            if (!$profile) return null;

            $age = $profile->dob ? \Carbon\Carbon::parse($profile->dob)->age : null;
            $matchPercentage = $calculateMatch($profile);

            return [
                'id' => $user->id,
                'name' => $user->name,
                'age' => $age,
                'height' => $profile->height ?? '',
                'gender' => $profile->gender,
                'email' => $user->email,
                'distance' => '1 km away',
                'profile_photo_url' => $user->profile_photo_path
                    ? asset('storage/' . $user->profile_photo_path)
                    : null,
                'match_percentage' => $matchPercentage,
                'user_verify' => $user->user_verify,
            ];
        })->filter();
        //dd($usersFormatted);
        return $this->success('Users fetched successfully', [
            'users' => $usersFormatted->values()
        ]);
    }
    /*
    public function getActions(Request $request)
    {
        $allowedTypes = ['liked', 'superliked', 'save', 'blocked', 'dateAdminers'];
        $type = $request->query('type');

        if (!in_array($type, $allowedTypes)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid action type',
                'allowed_types' => $allowedTypes,
            ], 422);
        }

        $currentUserId = auth()->id();
        $currentUser = User::with('profile')->findOrFail($currentUserId);
        $currentProfile = $currentUser->profile;

        // Match percentage calculator
        $calculateMatch = function ($profile) use ($currentProfile) {
            $matchScore = 0;
            $totalCriteria = 10;

            if ($currentProfile->partner_body_type === $profile->body_type) $matchScore++;
            if ($currentProfile->partner_eye_color === $profile->eye_color) $matchScore++;
            if ($currentProfile->partner_hair_color === $profile->hair_color) $matchScore++;
            if ($currentProfile->partner_smoking_habits === $profile->smoking_habits) $matchScore++;
            if ($currentProfile->partner_dress_style === $profile->dress_stype) $matchScore++;
            if ($currentProfile->partner_financial_status === $profile->financial_status) $matchScore++;
            if ($currentProfile->partner_religion === $profile->religion) $matchScore++;
            if ($currentProfile->partner_vaccinated === $profile->vaccinated) $matchScore++;
            if ($currentProfile->partner_pets === $profile->pets) $matchScore++;

            $userSports = explode(',', strtolower($profile->sports));
            $preferredSports = explode(',', strtolower($currentProfile->partner_sports));
            $intersectSports = array_intersect($userSports, $preferredSports);
            if (count($intersectSports)) $matchScore++;

            return round(($matchScore / $totalCriteria) * 100);
        };

        $actions = UserAction::where('user_id', $currentUserId)
            ->where($type, true)
            ->with(['targetUser.profile'])
            ->get();

        $usersFormatted = $actions->map(function ($action) use ($calculateMatch) {
            $user = $action->targetUser;
            $profile = $user->profile;

            if (!$profile) return null;

            $age = $profile->dob ? \Carbon\Carbon::parse($profile->dob)->age : null;
            $matchPercentage = $calculateMatch($profile);

            return [
                'id' => $user->id,
                'name' => $user->name,
                'age' => $age,
                'email' => $user->email,
                'distance' => '1 km away',
                'profile_photo_url' => $user->profile_photo_path
                    ? asset('storage/' . $user->profile_photo_path)
                    : null,
                'match_percentage' => $matchPercentage,
                'user_verify' => $user->user_verify,
            ];
        })->filter();

        return $this->success('Users fetched successfully', [
            'users' => $usersFormatted->values()
        ]);
    }*/


    public function getActions_old(Request $request)
    {
        $allowedTypes = ['liked', 'superliked', 'save', 'blocked', 'dateAdminers'];

        $type = $request->query('type');

        if (!in_array($type, $allowedTypes)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid action type',
                'allowed_types' => $allowedTypes,
            ], 422);
        }

        $userId = auth()->id();

        // Get UserAction records with this action = true
        $actions = UserAction::where('user_id', $userId)
            ->where($type, true)
            ->with(['targetUser:id,name,nick_name,profile_photo_path']) // adjust fields as needed
            ->get();
        //dd($actions);
        // Format response with only the target user details
        $result = $actions->map(function ($action) {
            return [
                'target_user_id' => $action->target_user_id,
                'name' => $action->targetUser->name,
                'nick_name' => $action->targetUser->nick_name,
                'profile_photo_path' => asset('storage/' . $action->targetUser->profile_photo_path),
                'distance' => '1 km away',

            ];
        });
        return $this->success('User actions', [
            'success' => true,
            'type' => $type,
            'data' => $result,
        ]);
    }
    public function freezeAccount(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized user.',
                ], 401);
            }

            $user->freeze_account = true;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Your account has been frozen successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to freeze account.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function unfreezeAccount(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized user.',
                ], 401);
            }

            if (!$user->freeze_account) {
                return response()->json([
                    'status' => false,
                    'message' => 'Account is already active.',
                ], 400);
            }

            $user->freeze_account = false;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Your account has been unfrozen successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to unfreeze account.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function checkFreezeStatus()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized user.',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'freeze_account' => $user->freeze_account,
            'message' => $user->freeze_account
                ? 'Your account is currently frozen.'
                : 'Your account is active.',
        ]);
    }


    protected function getNotificationText($action)
    {
        switch ($action) {
            case 'like':
                return 'liked your profile';
            case 'superlike':
                return 'super liked your profile';
            case 'save':
                return 'saved your profile';
            case 'unsave':
                return 'unsaved your profile';
            case 'block':
                return 'blocked you';
            case 'unblock':
                return 'unblocked you';
            case 'dislike':
            case 'superdislike':
                return 'unmatched you';
            case 'dateAdminers':
                return 'added you to dateAdminers';
            case 'unDateAdminers':
                return 'removed you from dateAdminers';
            case 'dateinvite':
                return 'Invite your profile';
            default:
                return 'interacted with you';
        }
    }
}

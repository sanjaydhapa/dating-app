<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Build and return filtered users collection based on request and current user's profile
     *
     * @param Request $request
     * @param int $currentUserId
     * @param \Illuminate\Database\Eloquent\Model|null $currentProfile
     * @return \Illuminate\Support\Collection
     */
    public function getUsers(Request $request, $currentUser)
    {
        $currentProfile = $currentUser->profile;

        $blockedIds = UserAction::where('user_id', $currentUser->id)
            ->where('blocked', true)
            ->pluck('target_user_id');

        // Extract filters
        $distanceMin = $request->input('partner_distance_min');
        $distanceMax = $request->input('partner_distance_max');
        $heightMin   = $request->input('partner_height_min');
        $heightMax   = $request->input('partner_height_max');
        $ageMin      = $request->input('partner_age_min');
        $ageMax      = $request->input('partner_age_max');
        $location    = $request->input('location');
        $filter_type = $request->input('filter_type');
        $orderBy     = $request->input('order_by', 'new');
        $search      = $request->input('search');

        $currentLat  = $currentProfile->latitude ?? null;
        $currentLng  = $currentProfile->longitude ?? null;

        // --------------------
        // Build Query
        // --------------------
        $usersQuery = User::with(['profile', 'kyc', 'actionByCurrentUser'])
            ->where('status', 1)
            ->where('freeze_account', false)
            ->where('id', '!=', $currentUser->id)
            ->whereNotIn('id', $blockedIds);

        // Apply filters (include current user id for activity-based filters)
        $this->applyFilters($usersQuery, $filter_type, $currentProfile, $currentLat, $currentLng, $currentUser->id, $heightMin, $heightMax, $ageMin, $ageMax, $location);

        // Search
        if (!empty($search)) {
            $usersQuery->where('nick_name', 'like', '%' . $search . '%');
        }

        // Ordering
        $this->applyOrdering($usersQuery, $filter_type, $orderBy);

        $users = $usersQuery->get();

        // Nearby post-filtering
        if ($filter_type == 'nearby' && $currentLat !== null && $currentLng !== null) {
            $users = $this->filterNearby($users, $currentLat, $currentLng);
        }

        return $this->formatUsers($users, $currentProfile, $filter_type, $currentLat, $currentLng);
    }

    /**
     * Return users grouped by the tags found in profile.iam_looking_for
     * Example: 'Adventure,Intimate encounter,Short term' => groups for each tag
     *
     * @param Request $request
     * @param \\App\\Models\\User $currentUser
     * @return array<string, \Illuminate\Support\Collection>
     */
    public function getUsersGroupedByLookingFor(Request $request, $currentUser)
    {
        $currentProfile = $currentUser->profile;
        $currentLat  = $currentProfile->latitude ?? null;
        $currentLng  = $currentProfile->longitude ?? null;

        // Exclude blocked users
        $blockedIds = UserAction::where('user_id', $currentUser->id)
            ->where('blocked', true)
            ->pluck('target_user_id')
            ->toArray();

        // Collect all iam_looking_for values from profiles and split into unique tags
        $allStrings = DB::table('user_profiles')
            ->whereNotNull('iam_looking_for')
            ->pluck('iam_looking_for')
            ->toArray();

        $tags = [];
        foreach ($allStrings as $str) {
            foreach (explode(',', $str) as $part) {
                $tag = trim($part);
                if ($tag !== '') {
                    $tags[strtolower($tag)] = $tag; // keep lowercase key but original value
                }
            }
        }

        // Check if request has "looking_for"
        if ($request->filled('looking_for')) {
            $filterTag = strtolower(trim($request->looking_for));

            // Only keep the requested tag
            if (isset($tags[$filterTag])) {
                $tags = [$filterTag => $tags[$filterTag]];
            } else {
                return []; // no matching tag found
            }
        }

        $result = [];
        foreach ($tags as $lower => $original) {
            // Query users whose profile iam_looking_for contains this tag
            $usersQuery = User::with(['profile', 'kyc', 'actionByCurrentUser', 'viewCount'])
                ->where('status', 1)
                ->where('freeze_account', false)
                ->where('id', '!=', $currentUser->id)
                ->whereNotIn('id', $blockedIds)
                ->whereHas('profile', function ($q) use ($lower) {
                    $q->whereRaw('LOWER(iam_looking_for) LIKE ?', ['%' . $lower . '%']);
                });

            // Optional search filter from request (applies to nick_name)
            if ($request->filled('search')) {
                $usersQuery->where('nick_name', 'like', '%' . $request->search . '%');
            }

            $users = $usersQuery->get();

            $formatted = $this->formatUsers($users, $currentProfile, null, $currentLat, $currentLng)->values();
            $result[$original] = $formatted;
        }

        return $result;
    }


    private function applyFilters($query, $filter_type, $currentProfile, $currentLat, $currentLng, $currentUserId, $heightMin, $heightMax, $ageMin, $ageMax, $location)
    {
        // Profile-based filters
        $query->whereHas('profile', function ($q) use ($heightMin, $heightMax, $ageMin, $ageMax, $currentProfile, $filter_type, $currentLat, $currentLng) {
            if ($heightMin && $heightMax) {
                $q->whereBetween('height', [$heightMin, $heightMax]);
            }

            if ($filter_type == 'nearby' && $currentLat && $currentLng) {
                $haversine = "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))";
                $q->whereRaw("$haversine < 50", [$currentLat, $currentLng, $currentLat]);
            }

            if ($ageMin && $ageMax) {
                $q->whereRaw('TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN ? AND ?', [(int)$ageMin, (int)$ageMax]);
            }

            // Gender preference
            if (!empty($currentProfile->iam_seeking)) {
                $rawGenders = array_map('trim', explode(',', $currentProfile->iam_seeking));
                if (!in_array('Couple', $rawGenders) && !in_array('no preference', array_map('strtolower', $rawGenders))) {
                    $genderMap = ['Man' => 'Male', 'Woman' => 'Female'];
                    $mappedGenders = array_filter(array_map(fn($g) => $genderMap[$g] ?? null, $rawGenders));
                    if ($mappedGenders) $q->whereIn('gender', $mappedGenders);
                }
            }
        });

        $query->whereHas('kyc', function ($q) use ($location) {
            if ($location) {
                $q->where('location', 'like', '%' . $location . '%');
            }
        });

        if ($filter_type == 'verified') {
            $query->where('user_verify', 1);
        }

        if ($filter_type == 'popular') {
            $query->withCount(['viewCount as is_view_count' => fn($q) => $q->where('is_view', 1)])
                ->having('is_view_count', '>', 0)
                ->orderByDesc('is_view_count');
        }

        if ($filter_type == 'online') {
            $query->where('is_online', true);
        }

        // Recent activity: show users that the current user has activity records for
        if ($filter_type == 'recent') {
            $recentTargetIds = UserAction::where('user_id', $currentUserId)
                ->orderBy('updated_at', 'desc')
                ->pluck('target_user_id')
                ->filter()->values()->all();

            if (!empty($recentTargetIds)) {
                // constrain users to the recent targets and preserve recent order using FIELD
                $query->whereIn('id', $recentTargetIds)
                    ->orderByRaw('FIELD(id, ' . implode(',', array_map('intval', $recentTargetIds)) . ')');
            } else {
                // no recent activity -> return empty result
                $query->whereRaw('0 = 1');
            }
        }

        if ($filter_type == 'unseen') {
            $seenUserIds = UserAction::where('user_id', $currentUserId)
                ->pluck('target_user_id')
                ->toArray();
            if (!empty($seenUserIds)) {
                $query->whereNotIn('id', $seenUserIds);
            }
        }
    }

    private function applyOrdering($query, $filter_type, $orderBy)
    {
        if ($filter_type == 'newest' || $orderBy === 'newest') {
            $query->orderBy('id', 'desc');
        } elseif ($filter_type == 'oldest' || $orderBy === 'oldest') {
            $query->orderBy('id', 'asc');
        } else {
            $query->orderBy('id', 'asc');
        }
    }

    private function filterNearby($users, $currentLat, $currentLng)
    {
        return $users->filter(function ($user) use ($currentLat, $currentLng) {
            $profile = $user->profile;
            if (!$profile || !is_numeric($profile->latitude) || !is_numeric($profile->longitude)) return false;
            $km = $this->calculateDistanceKm($currentLat, $currentLng, $profile->latitude, $profile->longitude);
            return $km !== null && $km <= 50;
        })->sortBy(function ($user) use ($currentLat, $currentLng) {
            $profile = $user->profile;
            if (!$profile || !is_numeric($profile->latitude) || !is_numeric($profile->longitude)) return PHP_INT_MAX;
            $km = $this->calculateDistanceKm($currentLat, $currentLng, $profile->latitude, $profile->longitude);
            return $km === null ? PHP_INT_MAX : $km;
        })->values();
    }

    private function formatUsers($users, $currentProfile, $filter_type, $currentLat, $currentLng)
    {
        return $users->map(function ($user) use ($currentProfile, $filter_type, $currentLat, $currentLng) {
            $profile = $user->profile;
            if (!$profile) return null;

            $age = $profile->dob ? Carbon::parse($profile->dob)->age : null;

            // Match percentage
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

            $userSports = explode(',', strtolower($profile->sports ?? ''));
            $preferredSports = explode(',', strtolower($currentProfile->partner_sports ?? ''));
            if (count(array_intersect($userSports, $preferredSports))) $matchScore++;

            $matchPercentage = round(($matchScore / $totalCriteria) * 100);

            // Actions
            $action = $user->actionByCurrentUser;
            $actionStatus = [
                'liked'       => $action?->liked ?? false,
                'superliked'  => $action?->superliked ?? false,
                'blocked'     => $action?->blocked ?? false,
                'save'        => $action?->save ?? false,
                'dateAdminers' => $action?->dateAdminers ?? false,
                'dateinvite'  => $action?->dateinvite ?? false,
            ];

            // Distance
            $distance = '';

            $km = $this->calculateDistanceKm($currentLat, $currentLng, $profile->latitude, $profile->longitude);
            if ($km !== null) {
                $distance = round($km, 2) . ' km';
            }


            return [
                'id'            => $user->id,
                'name'          => $user->name,
                'nick_name'     => $user->nick_name,
                'age'           => $age,
                'height'        => $profile->height,
                'gender'        => $profile->gender,
                'email'         => $user->email,
                'distance'      => $distance,
                'profile_photo' => $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : null,
                'match_percentage' => $matchPercentage,
                'user_verify'   => $user->user_verify,
                'view_count'    => $user->viewCount->count() ?? 0,
                'action'        => $actionStatus,
            ];
        })->filter();
    }

    /**
     * Calculate distance between two lat/lng points in kilometers using haversine formula.
     * Returns null if inputs are invalid.
     *
     * @param float|int $lat1
     * @param float|int $lng1
     * @param float|int $lat2
     * @param float|int $lng2
     * @return float|null
     */
    private function calculateDistanceKm($lat1, $lng1, $lat2, $lng2)
    {
        if (!is_numeric($lat1) || !is_numeric($lng1) || !is_numeric($lat2) || !is_numeric($lng2)) {
            return null;
        }

        $lat1 = floatval($lat1);
        $lng1 = floatval($lng1);
        $lat2 = floatval($lat2);
        $lng2 = floatval($lng2);

        // convert to radians
        $lat1Rad = deg2rad($lat1);
        $lng1Rad = deg2rad($lng1);
        $lat2Rad = deg2rad($lat2);
        $lng2Rad = deg2rad($lng2);

        $dLat = $lat2Rad - $lat1Rad;
        $dLng = $lng2Rad - $lng1Rad;

        $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1Rad) * cos($lat2Rad) * sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(max(0, 1 - $a)));

        $earthRadiusKm = 6371.0;
        return $earthRadiusKm * $c;
    }

    private function IAmLookingFor(){

    }
}

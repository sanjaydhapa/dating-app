<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Story;
use App\Models\StoryView;
use App\Traits\ApiResponse;

class StoryController extends Controller
{
    use ApiResponse;
    public function addStory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'media' => 'required|file|mimes:jpeg,png,jpg,mp4|max:10240',
            'text' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('media');
        $path = $file->store('stories', 'public');

        $mediaType = str_contains($file->getMimeType(), 'video') ? 'video' : 'image';

        $story = Story::create([
            'user_id' => auth()->id(),
            'media_url' => Storage::url($path),
            'media_type' => $mediaType,
            'text' => $request->text,
            'expires_at' => now()->addHours(24),
        ]);
        return $this->success('Story added successfully', [
            'story' => $story,
        ]);
        //return response()->json(['message' => 'Story added', 'story' => $story], 201);
    }

    public function viewStories()
    {
        $stories = Story::where('user_id', '!=', auth()->id())
            ->where('expires_at', '>', now())
            ->with(['user:id,name,nick_name'])
            ->get(['id', 'user_id', 'media_url', 'media_type', 'text', 'likes'])
            ->groupBy('user_id')
            ->map(function ($userStories) {
                $user = $userStories->first()->user;

                return [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'nick_name' => $user->nick_name,
                    'stories' => $userStories->map(function ($story) {
                        return [
                            'id' => $story->id,
                            'media_url' => asset($story->media_url),
                            'media_type' => $story->media_type,
                            'text' => $story->text,
                            'likes' => $story->likes,
                        ];
                    })->values(), // reset keys
                ];
            })->values(); // reset keys for outer group

        return $this->success('Story List', [
            'stories' => $stories,
        ]);
    }
    public function viewStories_old()
    {
        $stories = Story::where('user_id', '!=', auth()->id())
            ->where('expires_at', '>', now())
            ->with(['user:id,name,nick_name']) // only these fields from User
            ->get(['id', 'user_id', 'media_url', 'media_type', 'text', 'likes']) // only needed story fields
            ->map(function ($story) {
                return [
                    'id' => $story->id,
                    'user_id' => $story->user_id,
                    'media_url' => asset($story->media_url),
                    'media_type' => $story->media_type,
                    'text' => $story->text,
                    'likes' => $story->likes,
                    'user' => [
                        'name' => $story->user->name,
                        'nick_name' => $story->user->nick_name,
                    ],
                ];
            });

        //return response()->json($stories);
        return $this->success('Story List', [
            'stories' => $stories,
        ]);
    }


    public function markAsViewed($storyId)
    {
        $story = Story::findOrFail($storyId);

        // Don't record multiple views
        StoryView::firstOrCreate([
            'story_id' => $storyId,
            'user_id' => auth()->id(),
        ]);

        //return response()->json(['message' => 'Story marked as viewed']);
        return $this->success('Story marked as viewed');
    }

    public function likeStory($storyId)
    {
        $story = Story::findOrFail($storyId);
        $story->increment('likes');
        return $this->success('Story liked');
        //return response()->json(['message' => 'Story liked']);
    }

    public function myStories()
    {
        $stories = Story::where('user_id', auth()->id())
                    ->where('expires_at', '>', now())
                    ->get()
                    ->map(function ($story) {
                        $story->media_url = asset($story->media_url);
                        return $story;
                    });
        //return response()->json($stories);
        return $this->success('Story List', [
            'stories' => $stories,
        ]);
    }
}

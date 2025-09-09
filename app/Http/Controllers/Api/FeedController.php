<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feed;
use App\Traits\ApiResponse;
class FeedController extends Controller
{
    use ApiResponse;
    public function store(Request $request){
        
        $request->validate([
            'text' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov',
            //'is_private' => 'boolean',
        ]);
    
        $feed = new Feed();
        $feed->user_id = auth()->id();
        $feed->text = $request->text;
        $feed->is_private = $request->is_private ?? false;
    
        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $path = $media->store('feeds', 'public');
            $feed->media_path = $path;
            $feed->media_type = in_array($media->extension(), ['mp4', 'mov']) ? 'video' : 'image';
        }
    
        $feed->save();
        return $this->success('Feed created', [
            'feed' => $feed,
        ]);
        //return response()->json(['message' => 'Feed created', 'feed' => $feed]);
    }
    
    public function index()
    {
        $feeds = Feed::where(function($q){
            $q->where('is_private', false)->orWhere('user_id', auth()->id());
        })
        ->with(['user', 'feedComments.replies', 'feedComments.user'])
        ->latest()->get();
        return $this->success('Feed List', [
            'feeds' => $feeds,
        ]);
        //return response()->json($feeds);
    }
    
    public function show($id)
    {
        $feed = Feed::with(['user', 'feedComments.replies.user', 'feedComments.user'])
            ->where(function($q){
                $q->where('is_private', false)->orWhere('user_id', auth()->id());
            })->findOrFail($id);
    
        //return response()->json($feed);
        return $this->success('Feed Detail', [
            'feed' => $feed,
        ]);
    }

}

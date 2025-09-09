<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $request->validate([
            'type' => 'required|in:feed,comment',
            'id' => 'required|integer'
        ]);
    
        $model = $request->type === 'feed' ? Feed::class : Comment::class;
    
        $likeable = $model::findOrFail($request->id);
    
        $like = $likeable->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
    
        return response()->json(['message' => 'Liked successfully']);
    }

}

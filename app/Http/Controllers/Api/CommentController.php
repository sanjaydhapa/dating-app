<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class CommentController extends Controller
{
    
    public function store(Request $request, $feedId)
    {
        try {
            // Manual validator for consistent JSON error format
            $validator = Validator::make($request->all(), [
                'comment' => 'required|string',
                'parent_id' => 'nullable|exists:comments,id',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }
    
            $validated = $validator->validated();
    
            // Create the comment
            $comment = Comment::create([
                'user_id' => auth()->id(),
                'feed_id' => $feedId,
                'parent_id' => $validated['parent_id'] ?? null,
                'comment' => $validated['comment'],
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully',
                'comment' => $comment
            ]);
    
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Related model not found',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}

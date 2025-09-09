<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class ContactController extends Controller
{
    public function storeMessages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',//max:1000
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $contact = ContactMessage::create([
            'user_id' => auth()->id(), 
            'message' => $request->message,
        ]);
        Log::info('Contact message submitted:', [
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Message submitted successfully.',
            'data' => $contact,
        ]);
    }
    public function getMessages()
    {
        $userId = auth()->id();
    
        $messages = \App\Models\ContactMessage::where('user_id', $userId)
            ->latest()
            ->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Contact messages fetched successfully.',
            'data' => $messages,
        ]);
    }
}

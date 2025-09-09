<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // Already exists: storeMessages(), getMessages()

    public function listMessages()
    {
        $messages = ContactMessage::with('user')->latest()->get();
        return view('backend.contact.list', compact('messages'));
    }

    public function replyForm($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('backend.contact.reply', compact('message'));
    }

    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $message = ContactMessage::findOrFail($id);
        $message->reply = $request->reply;
        $message->save();

        return redirect()->route('admin.contact.list')->with('success', 'Reply sent successfully.');
    }
}


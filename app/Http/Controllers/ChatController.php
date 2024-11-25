<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Display the chat interface
    public function index()
    {
        $messages = Message::with('user')->latest()->take(50)->get()->reverse();
        return view('chat', compact('messages'));
    }

    // Handle sending messages
    public function sendMessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Save the message to the database
        $message = new Message();
        $message->user_id = Auth::id();
        $message->content = $request->input('content');
        $message->save();

        // Redirect back to the chat
        return redirect()->route('chat.index');
    }

    public function getMessages(Request $request)
    {
        $offset = $request->input('offset');
        $limit = $request->input('limit');

        $messages = Message::with('user')
            ->latest()
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json([
            'messages' => $messages,
        ]);
    }
}


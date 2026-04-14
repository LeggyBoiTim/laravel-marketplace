<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Conversation;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        Message::create([
            'conversation_id' => $request->conversation_id,
            'user_id' => $request->user_id,
            'content' => $request->content,
        ]);

        Conversation::where('id', $request->conversation_id)->update(['updated_at' => now()]);

        return redirect()->route('conversations.show', $request->conversation_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        Conversation::where('id', $message->conversation_id)->update(['updated_at' => $message->conversation->messages->last()->updated_at ?? now()]);

        return redirect()->route('conversations.show', $message->conversation_id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conversations = Conversation::where('user_id_1', Auth::id())
            ->orWhere('user_id_2', Auth::id())
            ->with(['userOne', 'userTwo'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('conversations.index', compact('conversations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        return view('conversations.show', compact('conversation'));
    }

    /**
     * Store a newly created resource in storage if it doesn't exist, otherwise redirect to the existing conversation.
     */
    public function firstOrCreate(User $otherUser)
    {
        [$userId1, $userId2] = Conversation::orderUserIds(Auth::id(), $otherUser->id);

        $conversation = Conversation::firstOrCreate([
            'user_id_1' => $userId1,
            'user_id_2' => $userId2
        ]);

        return redirect()->route('conversations.show', $conversation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

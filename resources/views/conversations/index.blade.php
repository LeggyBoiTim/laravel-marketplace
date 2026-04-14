<x-layout title="Inbox">
    <h1>Inbox</h1>
    <hr>

    @forelse($conversations as $conversation)
        <a href="{{ route('conversations.show', $conversation) }}" style="text-decoration: none; color: inherit; display: block; width: 25%;">
            <div style="margin-bottom: 1em; width: 100%; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                <strong>{{ $conversation->otherUser()->name }}</strong><br>
                @if($conversation->messages->last())
                    @if($conversation->messages->last()->user_id === Auth::id())
                        <span style="color: gray;">{{ 'You: ' . ($conversation->messages->last()->content) }}</span>
                    @else
                        <span style="color: gray;">{{ $conversation->messages->last()->user->name . ': ' . ($conversation->messages->last()->content) }}</span>
                    @endif
                    <span style="color: gray; float: right;">{{ $conversation->messages->last()->updated_at->diffForHumans() }}</span>
                @else
                    <span style="color: gray;">No messages yet.</span>
                @endif
            </div>
        </a>
    @empty
        <p>No conversations found.</p>
    @endforelse
</x-layout>
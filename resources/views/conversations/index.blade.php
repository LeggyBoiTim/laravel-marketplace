<x-layout title="Inbox">
    <h1>Inbox</h1>
    <hr>

    @forelse($conversations as $conversation)
        <div style="display: block; margin-bottom: 1em; width: fit-content;">
            <a href="{{ route('conversations.show', $conversation) }}" style="display:inline-block; width: auto; text-decoration: none; color: inherit;">
                <div style="position: relative; width: 100%; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                    <strong>{{ $conversation->otherUser()->name }}</strong>
                    @if($conversation->messages->last())
                        <span style="margin-left: 0.5em;">{{ $conversation->messages->last()->updated_at->diffForHumans() }}</span>
                        <br>
                        @if($conversation->messages->last()->user_id === Auth::id())
                            <span style="color: gray;">{{ 'You: ' . ($conversation->messages->last()->content) }}</span>
                        @else
                            <span style="color: gray;">{{ $conversation->messages->last()->user->name . ': ' . ($conversation->messages->last()->content) }}</span>
                        @endif
                    @else
                        <br>
                        <span style="color: gray;">No messages yet.</span>
                    @endif
                </div>
            </a>
            <div style="display: inline-block; margin-left: 2em;">
                <form action="{{ route('conversations.destroy', $conversation) }}" method="POST" style="display: block-inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this conversation and all of its messages?')">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <p>No conversations found.</p>
    @endforelse
</x-layout>
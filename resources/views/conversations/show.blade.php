<x-layout title="Conversation with {{ $conversation->otherUser()->name }}">
    <h1>Conversation with {{ $conversation->otherUser()->name }}</h1>
    <hr>

    @forelse($conversation->messages as $message)
        <div style="display: block; margin-bottom: 1em; width: 25%;">
            <div style="display: inline-block; width: auto;">
                <strong>{{ $message->user->name }}:</strong><br>
                <span>{{ $message->content }}</span>
            </div>
            <div style="display: inline-block; margin-left: 1em;">
                @if($message->user_id === Auth::id())
                    <form action="{{ route('messages.destroy', $message) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p>No messages yet.</p>
    @endforelse
    
    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
        <label for="content">New message:</label><br>
        <textarea name="content" rows="3" style="width: 25%;"></textarea><br>
        <button type="submit">Send</button>
    </form>
    <br>
</x-layout>
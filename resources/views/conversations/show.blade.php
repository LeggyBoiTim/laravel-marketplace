<x-layout title="Conversation with {{ $conversation->otherUser()->name }}">
    <h1>Conversation with {{ $conversation->otherUser()->name }}</h1>
    <hr>

    @forelse($conversation->messages as $message)
        <div style="margin-bottom: 1em;">
            <strong>{{ $message->user->name }}:</strong><br>
            <span>{{ $message->content }}</span>
            @if($message->user_id === Auth::id())
                <form action="{{ route('messages.destroy', $message) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            @endif
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
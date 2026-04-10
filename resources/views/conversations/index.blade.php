<x-layout title="Inbox">
    <h1>Inbox</h1>
    <hr>

    @forelse($conversations as $conversation)
        <div style="margin-bottom: 1em;">
            <a href="{{ route('conversations.show', $conversation) }}" style="text-decoration: none; color: inherit;">
                <strong>{{ $conversation->otherUser()->name }}</strong><br>
                <span style="color: gray;">{{ $conversation->latestMessage()->content ?? 'No messages yet' }}</span>
            </a>
            <br>
        </div>
    @empty
        <p>No conversations found.</p>
    @endforelse
</x-layout>
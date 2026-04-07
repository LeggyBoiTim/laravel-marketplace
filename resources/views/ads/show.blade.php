<x-layout title="{{ $ad->title }}">
    <h1>{{ $ad->title }}</h1>
    <p>{{ $ad->description }}</p>
    <span>Price: ${{ number_format($ad->price, 2) }}</span>
    @auth
        @if (Auth::id() === $ad->user_id)
            <a href="{{ route('ads.edit', $ad) }}" style="margin-left: 0.25em;"><button>Edit</button></a>
            <form action="{{ route('ads.destroy', $ad) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this ad?')">Delete</button>
            </form>
        @endif
    @endauth
    <hr>

    <h2>Place Bid</h2>
    @auth
        @if (Auth::id() === $ad->user_id)
            <p>You cannot place a bid on your own ad.</p>
        @else
            <form action="{{ route('bids.store', $ad) }}" method="POST">
                @csrf
                <label for="price">Bid Amount:</label>
                <input type="number" name="price" id="price" step="0.01" min="0" required>
                <x-error field="price" />
                <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                <button type="submit">Place Bid</button>
            </form>
        @endif
        <hr>
    @else
        <p><a href="{{ route('login') }}">Log in</a> to place a bid.</p>
    @endauth

    <h2>Bids</h2>
    @forelse ($ad->bids as $bid)
        <span>${{ number_format($bid->price, 2) }} by {{ $bid->user->name }}</span>
        @if (Auth::id() === $bid->user_id)
            <form action="{{ route('bids.destroy', $bid) }}" method="POST" style="display: inline; margin-left: 0.25em;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this bid?')">Delete</button>
            </form>
        @endif
        <br><br>
    @empty
        <p>No bids have been placed yet.</p>
    @endforelse
</x-layout>
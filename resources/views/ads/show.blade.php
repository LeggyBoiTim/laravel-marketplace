<x-layout title="{{ $ad->title }}">
    <h1 style="margin-bottom: 0;">{{ $ad->title }}</h1>
    <span style="margin-right: 1em;">By: <i>{{ $ad->user->name }}</i></span>
    <span>Categories: <i>{{ $ad->categories->pluck('name')->join(', ') }}</i></span>
    <p>{{ $ad->description }}</p>
    <span style="color: darkgreen;">Price: ${{ number_format($ad->price, 2) }}</span>
    @auth
        @if (Auth::id() === $ad->user_id)
            <a href="{{ route('ads.edit', $ad) }}" style="margin-left: 0.25em;"><button>Edit</button></a>
            <form action="{{ route('ads.destroy', $ad) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this ad?')">Delete</button>
            </form>
        @else
            <a href="{{ route('conversations.firstOrCreate', $ad->user) }}" style="margin-left: 0.25em;"><button>Message Seller</button></a>
        @endif
    @else
        <p><a href="{{ route('login') }}">Log in</a> to message the seller.</p>
    @endauth
    <hr>

    <h2 style="margin-top: 0;">Place Bid</h2>
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

    <h2 style="margin-top: 0;">Bids</h2>
    @forelse ($ad->bids as $bid)
        <span><span style="color: darkgreen;">${{ number_format($bid->price, 2) }}</span> by <i>{{ $bid->user->name }}</i></span>
        @if (Auth::id() === $bid->user_id)
            <form action="{{ route('bids.destroy', $bid) }}" method="POST" style="display: inline; margin-left: 0.25em;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this bid?')">Delete</button>
            </form>
        @elseif (Auth::id() === $ad->user_id)
            <a href="{{ route('conversations.firstOrCreate', $bid->user) }}" style="margin-left: 0.25em;"><button>Message Bidder</button></a>
        @endif
        <br><br>
    @empty
        <p>No bids have been placed yet.</p>
    @endforelse
</x-layout>
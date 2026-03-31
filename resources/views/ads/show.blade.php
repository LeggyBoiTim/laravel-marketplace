<x-layout title="{{ $ad->title }}">
    <h1>{{ $ad->title }}</h1>
    <p>{{ $ad->description }}</p>
    <p>Price: ${{ number_format($ad->price, 2) }}</p>
    @auth
        @if (Auth::id() === $ad->user_id)
            <a href="{{ route('ads.edit', $ad) }}"><button>Edit</button></a>
            <form action="{{ route('ads.destroy', $ad) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this ad?')">Delete</button>
            </form>
        @endif
    @endauth
    <hr>
</x-layout>
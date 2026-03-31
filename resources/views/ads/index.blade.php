<x-layout title="All Ads">
    <h1>All Ads</h1>

    @forelse ($ads as $ad)
        <div>
            <h2>{{ $ad->title }}</h2>
            <p>By: {{ $ad->user->name }}</p>
            <p>{{ $ad->description }}</p>
            <p>Price: ${{ number_format($ad->price, 2) }}</p>
            <a href="{{ route('ads.show', $ad) }}">View Details</a>
        </div>
    @empty
        <p>No ads found.</p>
    @endforelse
</x-layout>
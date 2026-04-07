<x-layout title="{{ $title }}">
    <h1>{{ $title }}</h1>
    <hr>

    @if ($ads->hasPages())
        <h3 style="text-align: center;">{{ $ads->links() }}</h3>
        <hr>
    @endif

    @forelse ($ads as $ad)
        <div>
            <h2>{{ $ad->title }}</h2>
            <p><b>By: {{ $ad->user->name }}</b></p>
            <p>{{ $ad->description }}</p>
            <p>Categories: <i>{{ $ad->categories->pluck('name')->join(', ') }}</i></p>
            <p>Price: ${{ number_format($ad->price, 2) }}</p>
            <a href="{{ route('ads.show', $ad) }}">View Details</a>
        </div>
        <hr>
    @empty
        <p>No ads found.</p>
    @endforelse

    
    @if (url()->current() == route('ads.index'))
        <div style="position: fixed; top: 1em; right: 11em; margin-bottom: 1em;">
            <form method="GET" action="{{ route('ads.index') }}">
                <input type="text" name="search" placeholder="Search ads..." value="{{ request()->query('search') }}">
                <button type="submit">Search</button>
                @if (request()->query('category'))
                    <input type="hidden" name="category" value="{{ request()->query('category') }}">
                @endif
            </form>
        </div>

        <div style="position: fixed; top: 0.5em; right: 0.5em; border-radius: 0.5em; padding: 1em; background-color: #ddd;">
            <p style="margin:auto">Filter by category:</p><br>
            <select id="category-filter" name="category" onchange="location = this.value;">
                <option value="{{ route('ads.index') }}">All Categories</option>
                @forelse ($categories as $category)
                    <option value="{{ route('ads.index', ['category' => $category->id]) }}" {{ request()->query('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @empty
                    <option value="" disabled>No categories available</option>
                @endforelse
            </select>
        </div>
    @endif

    @if ($ads->hasPages())
        <h3 style="text-align: center;">{{ $ads->links() }}</h3>
    @endif
</x-layout>
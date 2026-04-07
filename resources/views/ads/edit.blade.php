<x-layout title="Edit Ad">
    <h1>Edit Ad</h1>
    <form action="{{ route('ads.update', $ad->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input style="width: 10%;" type="text" id="title" name="title" value="{{ $ad->title }}" required>
        <x-error field="title" />
        <br><br>

        <label for="description">Description:</label><br>
        <textarea style="width: 25%; height: 5em;" id="description" name="description" required>{{ $ad->description }}</textarea>
        <x-error field="description" />
        <br><br>

        <span>Categories:</span>
        @forelse ($categories as $category)
            <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}" style="margin-right: 0em;" {{ $ad->categories->contains($category) ? 'checked' : '' }}>
            <label for="category-{{ $category->id }}" style="margin-right: 0.5em;">{{ $category->name }}</label>
        @empty
            <p>No categories available</p>
        @endforelse
        <x-error field="categories" />
        <br><br>

        <label for="price">Price:</label>
        <input style="width: 10%;" type="number" id="price" name="price" step="0.01" value="{{ $ad->price }}" required>
        <x-error field="price" />
        <br><br>
        
        <button type="submit">Update Ad</button>
    </form>
</x-layout>
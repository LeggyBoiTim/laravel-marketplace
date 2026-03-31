<x-layout title="New Ad">
    <h1>New Ad</h1>
    <form action="{{ route('ads.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input style="width: 10%;" type="text" id="title" name="title" required>
        <x-error field="title" />
        <br><br>

        <label for="description">Description:</label><br>
        <textarea style="width: 25%; height: 5em;" id="description" name="description" required></textarea>
        <x-error field="description" />
        <br><br>

        <label for="price">Price:</label>
        <input style="width: 10%;" type="number" id="price" name="price" step="0.01" required>
        <x-error field="price" />
        <br><br>
        
        <button type="submit">Create Ad</button>
    </form>
</x-layout>
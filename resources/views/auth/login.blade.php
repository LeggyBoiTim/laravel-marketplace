<x-layout title="Log in">
    <h1>Log in</h1>
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="email" id="email" name="email" required>
        <x-error field="email" />
        <br>
        <label for="password">Password:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="password" id="password" name="password" required>
        <x-error field="email" />
        <br>
        <button type="submit">Log in</button>
    </form>
</x-layout>
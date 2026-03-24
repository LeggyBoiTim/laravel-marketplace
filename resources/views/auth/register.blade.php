<x-layout title="Register">
    <h1>Register</h1>
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="text" id="name" name="name" required>
        <x-error field="name" />
        <br>
        <label for="email">Email:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="email" id="email" name="email" required>
        <x-error field="email" />
        <br>
        <label for="password">Password:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="password" id="password" name="password" required>
        <x-error field="password" />
        <br>
        <label for="password_confirmation">Confirm Password:</label>
        <input style="margin-bottom: 1em; width: 10%;" type="password" id="password_confirmation" name="password_confirmation" required>
        <x-error field="password_confirmation" />
        <br>
        <button type="submit">Register</button>
    </form>
</x-layout>
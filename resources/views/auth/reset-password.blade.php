<x-layout title="Reset Password">
    <h1>Reset Password</h1>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input style="width: 10%;" type="email" id="email" name="email" required>
        <x-error field="email" />
        <br><br>
        <label for="password">Password:</label>
        <input style="width: 10%;" type="password" id="password" name="password" required>
        <x-error field="password" />
        <br><br>
        <label for="password_confirmation">Confirm Password:</label>
        <input style="width: 10%;" type="password" id="password_confirmation" name="password_confirmation" required>
        <x-error field="password_confirmation" />
        <br><br>
        <input type="hidden" id="token" name="token" value="{{ $token }}">
        <button type="submit">Change Password</button>
    </form>
</x-layout>
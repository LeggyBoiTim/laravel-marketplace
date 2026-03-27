<x-layout title="Log in">
    <h1>Log in</h1>
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input style="width: 10%;" type="email" id="email" name="email" required>
        <x-error field="email" />
        <br><br>
        <label for="password">Password:</label>
        <input style="width: 10%;" type="password" id="password" name="password" required>
        <x-error field="password" />
        <br><br>
        <button type="submit">Log in</button>
    </form>
    <br>
    <a href="{{ route('password.request') }}">Forgot password?</a>
    @if(session('status'))
        <br><br>
        <div class="success-message" style="color: green;">
            {{ session('status') }}
        </div>
    @endif
</x-layout>
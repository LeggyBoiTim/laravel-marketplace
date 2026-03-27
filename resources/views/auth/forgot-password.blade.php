<x-layout title="Forgot Password">
    <h1>Forgot Password</h1>
    <p>Send a reset link to your e-mail:</p>
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input style="width: 10%;" type="email" id="email" name="email" required>
        <x-error field="email" />
        <br><br>
        <button type="submit">Send reset link</button>
    </form>
    @if(session('status'))
        <br>
        <div class="success-message" style="color: green;">
            {{ session('status') }} to {{ session('email') }}
        </div>
    @endif
</x-layout>
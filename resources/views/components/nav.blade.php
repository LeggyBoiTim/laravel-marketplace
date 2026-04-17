<nav>
    <a href="{{ route('ads.index') }}"><button style="margin-right: 1em;">All Ads</button></a>
    @auth
        <a href="{{ route('ads.create') }}"><button style="margin-right: 1em;">New Ad</button></a>
        <a href="{{ route('my-ads.index') }}"><button style="margin-right: 1em;">My Ads</button></a>
        <a href="{{ route('conversations.index') }}"><button style="margin-right: 1em;">Inbox</button></a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" style="margin-right: 1em;">Log out</button>
        </form>
        <form action="{{ route('notify-on-message.update', Auth::user()) }}" method="POST" style="display: inline;">
            @csrf
            @method('PUT')
            <input type="checkbox" name="notify_on_message" id="notify_on_message"
                value="1" {{ auth()->user()->notify_on_message ? 'checked' : '' }}
                onchange="this.form.submit();">
            <label for="notify_on_message">Receive message notifications</label>
        </form>
    @else
        <a href="{{ route('login.create') }}"><button style="margin-right: 1em;">Log in</button></a>
        <a href="{{ route('register.create') }}"><button style="margin-right: 1em;">Register</button></a>
    @endauth
</nav>
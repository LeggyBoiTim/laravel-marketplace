<nav>
    @auth
        <a href=""><button style="margin-right: 1em;">New Ad</button></a>
        <a href=""><button style="margin-right: 1em;">All Ads</button></a>
        <a href=""><button style="margin-right: 1em;">My Ads</button></a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Log out</button>
        </form>
    @else
        <a href="{{ route('login.create') }}"><button>Log in</button></a>
        <a href="{{ route('register.create') }}"><button>Register</button></a>
    @endauth
</nav>
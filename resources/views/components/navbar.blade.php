<nav>
    <div>
        <a href="{{ route('home') }}">
            {{ config('app.name') }}
        </a>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    Iziet
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">
                Ieiet
            </a>
            <a href="{{ route('register') }}">
                Reģistrēties
            </a>
        @endauth
    </div>
</nav>

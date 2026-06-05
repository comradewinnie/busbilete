<nav>
    <div>
        <a href="{{ route('home') }}">{{ config('app.name') }}</a>

        @auth
            <span>{{ auth()->user()->phone }}</span>
            
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}">Administratora panelis</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Iziet</button>
            </form>
        @else
            <a href="{{ route('login') }}">Ieiet</a>
            
            <a href="{{ route('register') }}">Reģistrēties</a>
        @endauth
    </div>
</nav>

<nav>
    <div>
        @foreach(['lv', 'ru', 'en'] as $lang)
            <form method="POST" action="{{ route('locale.switch', $lang) }}">
                @csrf
                <button type="submit" {{ app()->getLocale() === $lang ? 'disabled' : '' }}>{{ strtoupper($lang) }}</button>
            </form>
        @endforeach
    </div>

    <div>
        <a href="{{ route('home') }}">{{ config('app.name') }}</a>
    </div>

    <div>
        @auth
            <span>{{ auth()->user()->phone }}</span>

            <a href="{{ route('tickets.index') }}">{{ __('nav.my_tickets') }}</a>

            <a href="{{ route('favorites.index') }}">{{ __('nav.favorites') }}</a>

            <a href="{{ route('profile.show') }}">{{ __('nav.profile') }}</a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}">{{ __('nav.admin') }}</a>
            @endif

            <a href="{{ route('cart.index') }}">{{ __('nav.cart') }} ({{ count(session('cart', [])) }})</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">{{ __('nav.logout') }}</button>
            </form>
        @else
            <a href="{{ route('login') }}">{{ __('nav.login') }}</a>
            
            <a href="{{ route('register') }}">{{ __('nav.register') }}</a>
        @endauth
    </div>
</nav>

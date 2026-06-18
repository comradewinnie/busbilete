<nav class="navbar navbar-dark bg-danger">
    <div class="container-fluid gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex gap-1">
                @foreach(['lv', 'ru', 'en'] as $lang)
                    <form method="POST" action="{{ route('locale.switch', $lang) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm {{ app()->getLocale() === $lang ? 'btn-light' : 'btn-outline-light' }}">{{ strtoupper($lang) }}</button>
                    </form>
                @endforeach
            </div>

            <a class="navbar-brand m-0" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>

        <div class="d-flex align-items-center gap-2">
            @auth
                <a href="{{ route('tickets.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-ticket-perforated me-1"></i>{{ __('nav.my_tickets') }}
                </a>

                <a href="{{ route('favorites.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-heart me-1"></i>{{ __('nav.favorites') }}
                </a>

                <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-cart"></i> {{ __('nav.cart') }}
                    @if(count(session('cart', [])) > 0)
                        <span class="badge bg-light text-danger">{{ count(session('cart', [])) }}</span>
                    @endif
                </a>

                <a href="{{ route('profile.show') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-person me-1"></i>{{ auth()->user()->phone }}
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-shield me-1"></i>{{ __('nav.admin') }}
                    </a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm text-danger">
                        <i class="bi bi-box-arrow-right me-1"></i>{{ __('nav.logout') }}
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('nav.login') }}
                </a>

                <a href="{{ route('register') }}" class="btn btn-light btn-sm text-danger">
                    <i class="bi bi-person-plus me-1"></i>{{ __('nav.register') }}
                </a>
            @endauth
        </div>
    </div>
</nav>

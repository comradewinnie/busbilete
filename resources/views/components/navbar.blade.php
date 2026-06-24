<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
        <div class="d-flex align-items-center gap-3 me-3">
            <div class="d-flex gap-1">
                @foreach(['lv', 'ru', 'en'] as $lang)
                    <form method="POST" action="{{ route('locale.switch', $lang) }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm {{ app()->getLocale() === $lang ? 'btn-light' : 'btn-outline-light' }}">{{ strtoupper($lang) }}</button>
                    </form>
                @endforeach
            </div>

            <a class="navbar-brand m-0 fw-bold" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center gap-2 ms-auto mt-3 mt-lg-0">
                @auth
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-light btn-sm text-start text-lg-center whitespace-nowrap">
                        <i class="bi bi-ticket-perforated me-1"></i>{{ __('nav.my_tickets') }}
                    </a>

                    <a href="{{ route('favorites.index') }}" class="btn btn-outline-light btn-sm text-start text-lg-center whitespace-nowrap">
                        <i class="bi bi-heart me-1"></i>{{ __('nav.favorites') }}
                    </a>

                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm text-start text-lg-center whitespace-nowrap">
                        <i class="bi bi-cart me-1"></i>{{ __('nav.cart') }}
                        @if(count(session('cart', [])) > 0)
                            <span class="badge bg-light text-danger ms-1">{{ count(session('cart', [])) }}</span>
                        @endif
                    </a>

                    <a href="{{ route('profile.show') }}" class="btn btn-outline-light btn-sm text-start text-lg-center whitespace-nowrap">
                        <i class="bi bi-person me-1"></i>{{ auth()->user()->phone }}
                    </a>

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm text-start text-lg-center whitespace-nowrap">
                            <i class="bi bi-shield me-1"></i>{{ __('nav.admin') }}
                        </a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}" class="m-0 d-flex">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm text-danger w-100 text-start text-lg-center whitespace-nowrap">
                            <i class="bi bi-box-arrow-right me-1"></i>{{ __('nav.logout') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm text-start text-lg-center whitespace-nowrap">
                        <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('nav.login') }}
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-light btn-sm text-danger text-start text-lg-center whitespace-nowrap">
                        <i class="bi bi-person-plus me-1"></i>{{ __('nav.register') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
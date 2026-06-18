<x-layouts.app>
    <x-slot name="title">
        {{ __('auth.login') }}
    </x-slot>

    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 p-4">
                <h2 class="text-center mb-4 fw-bold text-danger">{{ __('auth.login') }}</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-medium">{{ __('auth.phone') }}</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-medium">{{ __('auth.password') }}</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="remember" name="remember" class="form-check-input">
                            <label for="remember" class="form-check-label text-muted">{{ __('auth.remember') }}</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 fw-bold mb-2">{{ __('auth.login') }}</button>

                    <div class="text-center">
                        <a href="{{ route('register') }}" class="text-danger text-decoration-none small">{{ __('auth.no_account') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
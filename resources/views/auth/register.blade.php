<x-layouts.app>
    <x-slot name="title">
        {{ __('auth.register') }}
    </x-slot>

    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 p-4">
                <h2 class="text-center mb-4 fw-bold text-danger">{{ __('auth.register') }}</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-medium">{{ __('auth.phone') }}</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-medium">{{ __('auth.password') }}</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-medium">{{ __('auth.confirm_pass') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 fw-bold mb-2">{{ __('auth.register') }}</button>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-danger text-decoration-none small">{{ __('auth.has_account') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
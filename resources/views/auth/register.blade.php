<x-layouts.app>
    <x-slot name="title">
        {{ __('auth.register') }}
    </x-slot>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="phone">{{ __('auth.phone') }}</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required autofocus>
        </div>

        <div>
            <label for="password">{{ __('auth.password') }}</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">{{ __('auth.confirm_pass') }}</label>
            <input type="password" id="password_confirmation"
                   name="password_confirmation" required>
        </div>

        <button type="submit">{{ __('auth.register') }}</button>

        <a href="{{ route('login') }}">{{ __('auth.has_account') }}</a>
    </form>
</x-layouts.app>
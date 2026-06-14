<x-layouts.app>
    <x-slot name="title">
        {{ __('auth.login') }}
    </x-slot>

    <form method="POST" action="{{ route('login') }}">
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
            <label for="remember">{{ __('auth.remember') }}</label>
            <input type="checkbox" id="remember" name="remember">
        </div>

        <button type="submit">{{ __('auth.login') }}</button>

        <a href="{{ route('register') }}">{{ __('auth.no_account') }}</a>
    </form>
</x-layouts.app>
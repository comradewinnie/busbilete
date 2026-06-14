<x-layouts.app>
    <x-slot name="title">
        {{ __('profile.edit') }}
    </x-slot>

    <h1>{{ __('profile.edit') }}</h1>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')
        <div>
            <label for="phone">{{ __('profile.phone_number') }}</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
        </div>

        <div>
            <label for="current_password">{{ __('profile.current_pass') }}</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div>
            <label for="password">{{ __('profile.new_pass') }}</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <label for="password_confirmation">{{ __('profile.confirm_pass') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit">{{ __('profile.save') }}</button>
        <a href="{{ route('profile.show') }}">{{ __('profile.cancel') }}</a>
    </form>
</x-layouts.app>
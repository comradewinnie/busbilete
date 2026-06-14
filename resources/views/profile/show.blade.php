<x-layouts.app>
    <x-slot name="title">
        {{ __('profile.title') }}
    </x-slot>

    <h1>{{ __('profile.title') }}</h1>

    <p><strong>{{ __('profile.phone') }}:</strong> {{ $user->phone }}</p>
    <p><strong>{{ __('profile.since') }}:</strong> {{ $user->created_at->format('d.m.Y') }}</p>

    <a href="{{ route('profile.edit') }}">{{ __('profile.edit') }}</a>

    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('{{ __('profile.confirm_delete') }}')">{{ __('profile.delete') }}</button>
    </form>
</x-layouts.app>
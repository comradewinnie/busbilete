<x-layouts.app>
    <x-slot name="title">
        {{ __('dashboard.title') }}
    </x-slot>

    <h1>{{ __('dashboard.title') }}</h1>
    <a href="{{ route('admin.users.index') }}">{{ __('dashboard.users') }}</a>
    <a href="{{ route('admin.tickets.index') }}">{{ __('dashboard.tickets') }}</a>
</x-layouts.app>
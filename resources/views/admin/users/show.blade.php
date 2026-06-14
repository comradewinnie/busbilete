<x-layouts.app>
    <x-slot name="title">
        {{ __('admin_users.title_2', ['phone' => $user->phone]) }}
    </x-slot>

    <h1>{{ $user->phone }}</h1>
    <p><strong>{{ __('admin_users.role') }}:</strong> {{ $user->role }}</p>
    <p><strong>{{ __('admin_users.since') }}:</strong> {{ $user->created_at->format('d.m.Y') }}</p>
    <p><strong>{{ __('admin_users.status') }}:</strong> {{ $user->trashed() ? __('admin_users.deleted') : __('admin_users.active') }}</p>

    @if($user->trashed())
        <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
            @csrf
            @method('PATCH')
            <button type="submit">{{ __('admin_users.restore') }}</button>
        </form>
    @else
        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">{{ __('admin_users.delete') }}</button>
        </form>
    @endif

    <a href="{{ route('admin.users.index') }}">{{ __('admin_users.back') }}</a>
</x-layouts.app>
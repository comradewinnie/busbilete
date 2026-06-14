<x-layouts.app>
    <x-slot name="title">
        {{ __('auth.restore_title') }}
    </x-slot>

    <h1>{{ __('auth.restore_title') }}</h1>
    <p>{!! __('auth.restore_account_deleted', ['phone' => $user->phone]) !!}</p>

    {!! __('auth.restore_account_deleted', ['phone' => $user->phone]) !!}
    {!! trans_choice('auth.restore_days_left', $daysLeft, ['days' => $daysLeft]) !!}
    <p>{{ __('auth.restore_warning') }}</p>

    <form action="{{ route('account.restore') }}" method="POST">
        @csrf
        <button type="submit">{{ __('auth.restore') }}</button>
    </form>

    <form action="{{ route('account.restore.cancel') }}" method="POST">
        @csrf
        <button type="submit">{{ __('auth.cancel') }}</button>
    </form>
</x-layouts.app>
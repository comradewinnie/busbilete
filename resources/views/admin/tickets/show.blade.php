<x-layouts.app>
    <x-slot name="title">
        {{ __('admin_tickets.title_2') }}
    </x-slot>

    <h1>{{ __('admin_tickets.title_2') }}</h1>
    <p><strong>{{ __('admin_tickets.id') }}:</strong> {{ $ticket->id }}</p>
    <p><strong>{{ __('admin_tickets.purchaser') }}:</strong> {{ $ticket->user->phone }}</p>
    <p><strong>{{ __('admin_tickets.route') }}:</strong> {{ $ticket->trip->tripPlan->route->name }}</p>
    <p><strong>{{ __('admin_tickets.date') }}:</strong> {{ $ticket->trip->date->format('d.m.Y') }}</p>
    <p><strong>{{ __('admin_tickets.from') }}:</strong> {{ $ticket->tariff->fromStop->name }}</p>
    <p><strong>{{ __('admin_tickets.to') }}:</strong> {{ $ticket->tariff->toStop->name }}</p>
    <p><strong>{{ __('admin_tickets.category') }}:</strong> {{ $ticket->category->name }}</p>
    <p><strong>{{ __('admin_tickets.price') }}:</strong> {{ number_format($ticket->price, 2) }} €</p>
    <p><strong>{{ __('admin_tickets.status') }}:</strong> {{ $ticket->trashed() ? __('admin_tickets.deleted') : __('admin_tickets.active') }}</p>

    @if($ticket->trashed())
        <form method="POST" action="{{ route('admin.tickets.restore', $ticket->id) }}">
            @csrf
            @method('PATCH')
            <button type="submit">{{ __('admin_tickets.restore') }}</button>
        </form>
    @else
        <form method="POST" action="{{ route('admin.tickets.destroy', $ticket->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">{{ __('admin_tickets.delete') }}</button>
        </form>
    @endif

    <a href="{{ route('admin.tickets.index') }}">{{ __('admin_tickets.back') }}</a>
</x-layouts.app>
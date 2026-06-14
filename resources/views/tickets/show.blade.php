<x-layouts.app>
    <x-slot name="title">
        {{ __('tickets.view_title') }}
    </x-slot>

    <h1>{{ __('tickets.view_title') }}</h1>

    <p><strong>{{ __('tickets.route') }}:</strong> {{ $ticket->trip->tripPlan->route->name }}</p>
    <p><strong>{{ __('tickets.date') }}:</strong> {{ $ticket->trip->date->format('d.m.Y') }}</p>
    <p><strong>{{ __('tickets.from') }}:</strong> {{ $ticket->tariff->fromStop->name }}</p>
    <p><strong>{{ __('tickets.time') }}:</strong> {{ $ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->from_stop_id)->departure_time }}</p>
    <p><strong>{{ __('tickets.to') }}:</strong> {{ $ticket->tariff->toStop->name }}</p>
    <p><strong>{{ __('tickets.time') }}:</strong> {{ $ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->to_stop_id)->departure_time }}</p>
    <p><strong>{{ __('tickets.category') }}:</strong> {{ $ticket->category->name }}</p>
    <p><strong>{{ __('tickets.price') }}:</strong> {{ number_format($ticket->price, 2) }} €</p>
    <p><strong>{{ __('tickets.purchase_time') }}:</strong> {{ $ticket->created_at->format('d.m.Y H:i') }}</p>

    <h2>{{ __('tickets.qr') }}</h2>
    <div>
        {!! QrCode::size(200)->generate($ticket->id) !!}
    </div>

    <a href="{{ route('tickets.index') }}">{{ __('tickets.back') }}</a>
</x-layouts.app>
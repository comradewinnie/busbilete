<x-layouts.app>
    <x-slot name="title">
        Biļete
    </x-slot>

    <h1>Biļete</h1>

    <p><strong>Maršruts:</strong> {{ $ticket->trip->tripPlan->route->name }}</p>
    <p><strong>Datums:</strong> {{ $ticket->trip->date->format('d.m.Y') }}</p>
    <p><strong>No:</strong> {{ $ticket->tariff->fromStop->name }}</p>
    <p><strong>Laiks:</strong> {{ $ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->from_stop_id)->departure_time }}</p>
    <p><strong>Līdz:</strong> {{ $ticket->tariff->toStop->name }}</p>
    <p><strong>Laiks:</strong> {{ $ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->to_stop_id)->departure_time }}</p>
    <p><strong>Kategorija:</strong> {{ $ticket->category->name }}</p>
    <p><strong>Cena:</strong> {{ number_format($ticket->price, 2) }} €</p>
    <p><strong>Iegādes laiks:</strong> {{ $ticket->created_at->format('d.m.Y H:i') }}</p>

    <h2>Kvadrātkods</h2>
    <div>
        {!! QrCode::size(200)->generate($ticket->id) !!}
    </div>

    <a href="{{ route('tickets.index') }}">Atpakaļ</a>
</x-layouts.app>
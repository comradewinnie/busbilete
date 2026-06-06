<x-layouts.app>
    <x-slot name="title">
        Biļete
    </x-slot>

    <h1>Biļete</h1>

    <p>Maršruts: {{ $ticket->trip->tripPlan->route->name }}</p>
    <p>Datums: {{ $ticket->trip->date->format('d.m.Y') }}</p>
    <p>No: {{ $ticket->tariff->fromStop->name }}</p>
    <p>Laiks: {{ $ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->from_stop_id)->departure_time }}</p>
    <p>Līdz: {{ $ticket->tariff->toStop->name }}</p>
    <p>Laiks: {{ $ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->to_stop_id)->departure_time }}</p>
    <p>Kategorija: {{ $ticket->category->name }}</p>
    <p>Cena: {{ number_format($ticket->price, 2) }} €</p>
    <p>Iegādes laiks: {{ $ticket->created_at->format('d.m.Y H:i') }}</p>

    <a href="{{ route('tickets.index') }}">Atpakaļ</a>
</x-layouts.app>
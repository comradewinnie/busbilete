<x-layouts.app>
    <x-slot name="title">
        Biļete
    </x-slot>

    <h1>Biļete</h1>
    <p>ID: {{ $ticket->id }}</p>
    <p>Pircēja tel.nr.: {{ $ticket->user->phone }}</p>
    <p>Maršruts: {{ $ticket->trip->tripPlan->route->name }}</p>
    <p>Datums: {{ $ticket->trip->date->format('d.m.Y') }}</p>
    <p>No: {{ $ticket->tariff->fromStop->name }}</p>
    <p>Līdz: {{ $ticket->tariff->toStop->name }}</p>
    <p>Kategorija: {{ $ticket->category->name }}</p>
    <p>Cena: {{ number_format($ticket->price, 2) }} €</p>
    <p>Statuss: {{ $ticket->trashed() ? 'Dzēsta' : 'Aktīva' }}</p>

    @if($ticket->trashed())
        <form method="POST" action="{{ route('admin.tickets.restore', $ticket->id) }}">
            @csrf
            @method('PATCH')
            <button type="submit">Atjaunot</button>
        </form>
    @else
        <form method="POST" action="{{ route('admin.tickets.destroy', $ticket->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Dzēst</button>
        </form>
    @endif

    <a href="{{ route('admin.tickets.index') }}">Atpakaļ</a>
</x-layouts.app>
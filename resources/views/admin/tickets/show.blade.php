<x-layouts.app>
    <x-slot name="title">
        Biļete
    </x-slot>

    <h1>Biļete</h1>
    <p><strong>ID:</strong> {{ $ticket->id }}</p>
    <p><strong>Pircēja tel.nr.:</strong> {{ $ticket->user->phone }}</p>
    <p><strong>Maršruts:</strong> {{ $ticket->trip->tripPlan->route->name }}</p>
    <p><strong>Datums:</strong> {{ $ticket->trip->date->format('d.m.Y') }}</p>
    <p><strong>No:</strong> {{ $ticket->tariff->fromStop->name }}</p>
    <p><strong>Līdz:</strong> {{ $ticket->tariff->toStop->name }}</p>
    <p><strong>Kategorija:</strong> {{ $ticket->category->name }}</p>
    <p><strong>Cena:</strong> {{ number_format($ticket->price, 2) }} €</p>
    <p><strong>Statuss:</strong> {{ $ticket->trashed() ? 'Dzēsta' : 'Aktīva' }}</p>

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
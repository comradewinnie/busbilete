<x-layouts.app>
    <x-slot name="title">
        Biļetes
    </x-slot>

    <h1>Biļetes</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pircēja tel.nr.</th>
                <th>Maršruts</th>
                <th>Datums</th>
                <th>Cena</th>
                <th>Statuss</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>
                        <a href="{{ route('admin.tickets.show', $ticket->id) }}">{{ Str::limit($ticket->id, 8, '') }}</a>
                    </td>
                    <td>{{ $ticket->user->phone }}</td>
                    <td>{{ $ticket->trip->tripPlan->route->name }}</td>
                    <td>{{ $ticket->trip->date->format('d.m.Y') }}</td>
                    <td>{{ number_format($ticket->price, 2) }} €</td>
                    <td>{{ $ticket->trashed() ? 'Dzēsta' : 'Aktīva' }}</td>
                    <td>
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
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}
</x-layouts.app>
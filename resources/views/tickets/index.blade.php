<x-layouts.app>
    <x-slot name="title">
        Manas biļetes
    </x-slot>

    <h1>Manas biļetes</h1>

    @if($tickets->isEmpty())
        <p>Jums nav biļešu.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Datums</th>
                    <th>No</th>
                    <th>Laiks</th>
                    <th>Līdz</th>
                    <th>Laiks</th>
                    <th>Cena</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->trip->date->format('d.m.Y') }}</td>
                        <td>{{ $ticket->tariff->fromStop->name }}</td>
                        <td>{{ $ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->from_stop_id)->departure_time }}</td>
                        <td>{{ $ticket->tariff->toStop->name }}</td>
                        <td>{{ $ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->to_stop_id)->departure_time }}</td>
                        <td>{{ $ticket->price }} €</td>
                        <td>
                            <a href="{{ route('tickets.show', $ticket->id) }}">Skatīt</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tickets->links() }}
    @endif
</x-layouts.app>
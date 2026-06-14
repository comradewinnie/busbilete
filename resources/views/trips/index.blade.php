<x-layouts.app>
    <x-slot name="title">
        Kustību saraksts
    </x-slot>

    <h1>Kustību saraksts</h1>

    <x-searchbar :stops="$stops" />
    
    @if($trips->isEmpty())
        <p>Tiešie reisi nav atrasti.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nr.</th>
                    <th>Maršruts</th>
                    <th>Pārvadātājs</th>
                    <th>Atiešana</th>
                    <th>Ierašanās</th>
                    <th>Cena</th>
                    <th>Brīvas vietas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($trips as $trip)
                    @php
                        $fromStop = $trip->tripPlan->stops->firstWhere('stop_id', request('from_stop_id'));
                        $toStop = $trip->tripPlan->stops->firstWhere('stop_id', request('to_stop_id'));
                        $tariff = $trip->tripPlan->route->tariffs
                            ->where('from_stop_id', request('from_stop_id'))
                            ->where('to_stop_id', request('to_stop_id'))
                            ->where('status', 'active')
                            ->first();
                    @endphp

                    <tr>
                        <td>{{ $trip->tripPlan->route->number }}</td>
                        <td>{{ $trip->tripPlan->route->name }}</td>
                        <td>{{ $trip->tripPlan->route->carrier->name }}</td>
                        <td>{{ $fromStop->departure_time }}</td>
                        <td>{{ $toStop->departure_time }}</td>
                        <td>{{ $tariff->price }} €</td>
                        <td>{{ $trip->available_seats }}</td>
                        <td><a href="{{ route('trips.show', ['trip' => $trip->id, 'from_stop_id' => request('from_stop_id'), 'to_stop_id' => request('to_stop_id'), 'date' => request('date')]) }}">Skatīt</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layouts.app>
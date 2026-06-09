<x-layouts.app>
    <x-slot name="title">
        Reiss
    </x-slot>

    <h2>Reiss</h2>
    <p><strong>Maršruts:</strong> {{ $trip->tripPlan->route->name }}</p>
    <p><strong>Pārvadātājs:</strong> {{ $trip->tripPlan->route->carrier->name }}</p>
    <p><strong>Datums:</strong> {{ $trip->date->format('d.m.Y') }}</p>
    <h2>Pieturas</h2>
    <table>
        <thead>
            <tr>
                <th>Pietura</th>
                <th>Laiks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stops as $stop)
                <tr>
                    <td>{{ $stop->name }}</td>
                    <td>{{ $trip->tripPlan->stops->firstWhere('stop_id', $stop->id)->departure_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Jūsu maršruts</h2>
    <p><strong>No:</strong> {{ $fromStop->name }}</p>
    <p><strong>Līdz:</strong> {{ $toStop->name }}</p>
    <p><strong>Palika sēdvietu:</strong> {{ $availableSeats }}/{{ $trip->bus->number_of_seats }}</p>
    <p><strong>Cena:</strong> {{ $tariff->price }} €</p>

    @auth
        @if($availableSeats > 0)
            <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                <input type="hidden" name="tariff_id" value="{{ $tariff->id }}">
                <button type="submit">Pievienot grozam</button>
            </form>
        @else
            <p>Nav brīvu vietu.</p>
        @endif
    @else
        <a href="{{ route('login') }}">Ieiet, lai iegādātos biļeti</a>
    @endauth

    <a href="{{ route('trips.index', ['from_stop_id' => $fromStop->id, 'to_stop_id' => $toStop->id, 'date' => $date]) }}">Atpakaļ</a>
</x-layouts.app>
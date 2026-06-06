<x-layouts.app>
    <x-slot name="title">
        Reiss
    </x-slot>

    <h2>Reiss</h2>
    <p><strong>Maršruts:</strong> {{ $trip->tripPlan->route->name }}</p>
    <p><strong>Pārvadātājs:</strong> {{ $trip->tripPlan->route->carrier->name }}</p>
    <p><strong>Datums:</strong> {{ $trip->date->format('d.m.Y') }}</p>
    <h2>Laiks pieturās:</h2>
    @foreach($stops as $stop)
        <p><strong>{{ $stop->name }}:</strong> {{ $trip->tripPlan->stops->firstWhere('stop_id', $stop->id)->departure_time }}</p>
    @endforeach

    <a href="{{ route('trips.index', ['from_stop_id' => $from_stop_id, 'to_stop_id' => $to_stop_id, 'date' => $date]) }}">Atpakaļ</a>
</x-layouts.app>
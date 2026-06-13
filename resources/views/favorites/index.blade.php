<x-layouts.app>
    <x-slot name="title">
        Iecienītākie maršruti
    </x-slot>

    <h1>Iecienītākie maršruti</h1>

    @if($routes->isEmpty())
        <p>Nav pievienotu maršrutu.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Numurs</th>
                    <th>Maršruts</th>
                    <th>Pārvadātājs</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($routes as $route)
                    <tr>
                        <td>{{ $route->number }}</td>
                        <td>{{ $route->name }}</td>
                        <td>{{ $route->carrier->name }}</td>
                        <td>
                            @php
                                $stops = $route->stops;
                                $firstStop = $stops->first();
                                $lastStop = $stops->last();
                            @endphp
                            <a href="{{ route('trips.index', ['from_stop_id' => $firstStop->id, 'to_stop_id' => $lastStop->id, 'date' => date('Y-m-d')]) }}">Meklēt reisus</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('favorites.destroy', $route->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Noņemt</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layouts.app>
<x-layouts.app>
    <x-slot name="title">
        {{ __('favorites.title') }}
    </x-slot>

    <h1>{{ __('favorites.title') }}</h1>

    @if($routes->isEmpty())
        <p>{{ __('favorites.empty') }}</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>{{ __('favorites.number') }}</th>
                    <th>{{ __('favorites.route') }}</th>
                    <th>{{ __('favorites.carrier') }}</th>
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
                            <a href="{{ route('trips.index', ['from_stop_id' => $firstStop->id, 'to_stop_id' => $lastStop->id, 'date' => date('Y-m-d')]) }}">{{ __('favorites.search') }}</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('favorites.destroy', $route->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">{{ __('favorites.remove') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layouts.app>
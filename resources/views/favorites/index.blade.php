<x-layouts.app>
    <x-slot name="title">
        {{ __('favorites.title') }}
    </x-slot>

    <h1>{{ __('favorites.title') }}</h1>

    @if($favorites->isEmpty())
        <p>{{ __('favorites.empty') }}</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>{{ __('favorites.number') }}</th>
                    <th>{{ __('favorites.route') }}</th>
                    <th>{{ __('favorites.carrier') }}</th>
                    <th>{{ __('favorites.from') }}</th>
                    <th>{{ __('favorites.to') }}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($favorites as $favorite)
                    <tr>
                        <td>{{ $favorite->route->number }}</td>
                        <td>{{ $favorite->route->name }}</td>
                        <td>{{ $favorite->route->carrier->name }}</td>
                        <td>{{ $favorite->fromStop->name }}</td>
                        <td>{{ $favorite->toStop->name }}</td>
                        <td>
                            <a href="{{ route('trips.index', ['from_stop_id' => $favorite->from_stop_id, 'to_stop_id' => $favorite->to_stop_id, 'date' => date('Y-m-d')]) }}">{{ __('favorites.search') }}</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('favorites.destroy', $favorite->id) }}">
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
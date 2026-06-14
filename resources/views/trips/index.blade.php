<x-layouts.app>
    <x-slot name="title">
        {{ __('trips.title') }}
    </x-slot>

    <h1>{{ __('trips.title') }}</h1>

    <x-searchbar :stops="$stops" />
    
    @if($trips->isEmpty())
        <p>{{ __('trips.not_found') }}</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>{{ __('trips.number') }}</th>
                    <th>{{ __('trips.route') }}</th>
                    <th>{{ __('trips.carrier') }}</th>
                    <th>{{ __('trips.departure') }}</th>
                    <th>{{ __('trips.arrival') }}</th>
                    <th>{{ __('trips.price') }}</th>
                    <th>{{ __('trips.seats') }}</th>
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
                        <td><a href="{{ route('trips.show', ['trip' => $trip->id, 'from_stop_id' => request('from_stop_id'), 'to_stop_id' => request('to_stop_id'), 'date' => request('date')]) }}">{{ __('trips.view') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layouts.app>
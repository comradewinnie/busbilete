<x-layouts.app>
    <x-slot name="title">
        {{ __('trips.show_title') }}
    </x-slot>

    <h1>{{ __('trips.show_title') }}</h1>
    <p><strong>{{ __('trips.route') }}:</strong> {{ $trip->tripPlan->route->name }}</p>
    <p><strong>{{ __('trips.route_number') }}:</strong> {{ $trip->tripPlan->route->number }}</p>
    <p><strong>{{ __('trips.carrier') }}:</strong> {{ $trip->tripPlan->route->carrier->name }}</p>
    <p><strong>{{ __('trips.date') }}:</strong> {{ $trip->date->format('d.m.Y') }}</p>
    <h2>{{ __('trips.stops') }}</h2>
    <table>
        <thead>
            <tr>
                <th>{{ __('trips.stop') }}</th>
                <th>{{ __('trips.time') }}</th>
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

    <h2>{{ __('trips.your_route') }}</h2>
    <p><strong>{{ __('trips.from') }}:</strong> {{ $fromStop->name }}</p>
    <p><strong>{{ __('trips.to') }}:</strong> {{ $toStop->name }}</p>
    <p><strong>{{ __('trips.seats_2') }}:</strong> {{ $availableSeats }}/{{ $trip->bus->number_of_seats }}</p>
    <p><strong>{{ __('trips.price') }}:</strong> {{ $tariff->price }} €</p>

    @auth
        @if($availableSeats > 0)
            <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                <input type="hidden" name="tariff_id" value="{{ $tariff->id }}">
                <button type="submit">{{ __('trips.add_cart') }}</button>
            </form>
        @else
            <p>{{ __('trips.no_seats') }}</p>
        @endif

        @php
            $isFavorite = auth()->user()->favoriteRoutes->contains($trip->tripPlan->route_id);
        @endphp

        @if($isFavorite)
            <form method="POST" action="{{ route('favorites.destroy', $trip->tripPlan->route_id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">{{ __('trips.unfavorite') }}</button>
            </form>
        @else
            <form method="POST" action="{{ route('favorites.store', $trip->tripPlan->route_id) }}">
                @csrf
                <button type="submit">{{ __('trips.favorite') }}</button>
            </form>
        @endif
    @else
        <a href="{{ route('login') }}">{{ __('trips.login') }}</a>
    @endauth

    <a href="{{ route('trips.index', ['from_stop_id' => $fromStop->id, 'to_stop_id' => $toStop->id, 'date' => $date]) }}">{{ __('trips.back') }}</a>
</x-layouts.app>
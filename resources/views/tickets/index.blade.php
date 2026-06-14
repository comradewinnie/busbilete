<x-layouts.app>
    <x-slot name="title">
        {{ __('tickets.title') }}
    </x-slot>

    <h1>{{ __('tickets.title') }}</h1>

    @if($tickets->isEmpty())
        <p>{{ __('tickets.empty') }}</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>{{ __('tickets.date') }}</th>
                    <th>{{ __('tickets.from') }}</th>
                    <th>{{ __('tickets.time') }}</th>
                    <th>{{ __('tickets.to') }}</th>
                    <th>{{ __('tickets.time') }}</th>
                    <th>{{ __('tickets.price') }}</th>
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
                            <a href="{{ route('tickets.show', $ticket->id) }}">{{ __('tickets.view') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tickets->links() }}
    @endif
</x-layouts.app>
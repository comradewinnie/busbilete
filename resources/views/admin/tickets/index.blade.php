<x-layouts.app>
    <x-slot name="title">
        {{ __('admin_tickets.title') }}
    </x-slot>

    <h1>{{ __('admin_tickets.title') }}</h1>

    <table>
        <thead>
            <tr>
                <th>{{ __('admin_tickets.id') }}</th>
                <th>{{ __('admin_tickets.purchaser') }}</th>
                <th>{{ __('admin_tickets.route') }}</th>
                <th>{{ __('admin_tickets.date') }}</th>
                <th>{{ __('admin_tickets.price') }}</th>
                <th>{{ __('admin_tickets.status') }}</th>
                <th>{{ __('admin_tickets.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>
                        <a href="{{ route('admin.tickets.show', $ticket->id) }}">{{ Str::limit($ticket->id, 8, '') }}</a>
                    </td>
                    <td>{{ $ticket->user->phone }}</td>
                    <td>{{ $ticket->trip->tripPlan->route->name }}</td>
                    <td>{{ $ticket->trip->date->format('d.m.Y') }}</td>
                    <td>{{ number_format($ticket->price, 2) }} €</td>
                    <td>{{ $ticket->trashed() ?  __('admin_tickets.deleted') : __('admin_tickets.active') }}</td>
                    <td>
                        @if($ticket->trashed())
                            <form method="POST" action="{{ route('admin.tickets.restore', $ticket->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit">{{ __('admin_tickets.restore') }}</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.tickets.destroy', $ticket->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">{{ __('admin_tickets.delete') }}</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}
</x-layouts.app>
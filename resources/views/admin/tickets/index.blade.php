<x-layouts.app>
    <x-slot name="title">
        {{ __('admin_tickets.title') }}
    </x-slot>

    <h1 class="fw-bold text-danger mb-4 fs-2">{{ __('admin_tickets.title') }}</h1>

    <div class="card border-0 shadow-sm overflow-hidden mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">{{ __('admin_tickets.id') }}</th>
                        <th>{{ __('admin_tickets.purchaser') }}</th>
                        <th>{{ __('admin_tickets.route') }}</th>
                        <th>{{ __('admin_tickets.date') }}</th>
                        <th>{{ __('admin_tickets.price') }}</th>
                        <th>{{ __('admin_tickets.status') }}</th>
                        <th class="pe-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td class="ps-4 fw-bold text-dark">{{ Str::limit($ticket->id, 8, '') }}</td>
                            <td class="text-dark">{{ $ticket->user->phone }}</td>
                            <td>{{ $ticket->trip->tripPlan->route->name }}</td>
                            <td class="text-muted small">{{ $ticket->trip->date->format('d.m.Y') }}</td>
                            <td class="fw-medium text-dark">{{ number_format($ticket->price, 2) }} €</td>
                            <td>
                                <span class="badge {{ $ticket->trashed() ? 'bg-secondary' : 'bg-success' }} fw-medium">{{ $ticket->trashed() ?  __('admin_tickets.deleted') : __('admin_tickets.active') }}</span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-outline-danger btn-sm fw-bold px-3">{{ __('tickets.view') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $tickets->links() }}
    </div>
</x-layouts.app>
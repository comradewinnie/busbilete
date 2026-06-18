<x-layouts.app>
    <x-slot name="title">
        {{ __('admin_tickets.title_2') }}
    </x-slot>

    <div class="mb-4 d-flex justify-content-center">
        <div class="col-md-8 col-lg-5">
            <a href="{{ route('admin.tickets.index') }}" class="text-danger text-decoration-none fw-medium small">
                <i class="bi bi-arrow-left me-1"></i> {{ __('admin_tickets.back') }}
            </a>
        </div>
    </div>

    <div class="row justify-content-center my-2">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 p-4 shadow-sm">
                <div class="d-inline-flex align-items-center justify-content-center bg-danger text-white rounded-circle mb-3 mx-auto" style="width: 80px; height: 80px;">
                    <i class="bi bi-ticket-perforated-fill fs-1"></i>
                </div>

                <h1 class="fw-bold text-danger fs-2 mb-4 text-center">{{ __('admin_tickets.title_2') }}</h1>

                <div class="row bg-light rounded p-3 mb-4 mx-0 align-items-center">
                    <div class="col-md-5">
                        <div class="text-muted small">
                            <i class="bi bi-house-door text-danger me-1"></i>{{ __('tickets.from') }}
                        </div>
                        <div class="fw-bold fs-5 text-dark">{{ $ticket->tariff->fromStop->name }}</div>
                        <span class="fs-5 fw-medium text-dark">
                            {{ \Carbon\Carbon::parse($ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->from_stop_id)->departure_time)->format('H:i') }}
                        </span>
                    </div>

                    <div class="col-md-2 text-center fs-4">
                        <i class="bi bi-arrow-right text-danger"></i>
                    </div>
                    
                    <div class="col-md-5 text-md-end">
                        <div class="text-muted small">
                            <i class="bi bi-geo-alt text-danger me-1"></i>{{ __('tickets.to') }}
                        </div>
                        <div class="fw-bold fs-5 text-dark">{{ $ticket->tariff->toStop->name }}</div>
                        <span class="fs-5 fw-medium text-dark">
                            {{ \Carbon\Carbon::parse($ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->to_stop_id)->departure_time)->format('H:i') }}
                        </span>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-6">
                        <div class="text-muted small">{{ __('admin_tickets.route') }}</div>
                        <div class="fw-medium fs-5 text-truncate" title="{{ $ticket->trip->tripPlan->route->name }}">{{ $ticket->trip->tripPlan->route->name }}</div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-muted small">{{ __('admin_tickets.carrier') }} </div>
                        <div class="fw-medium fs-5 text-truncate" title="{{ $ticket->trip->tripPlan->route->carrier->name }}">{{ $ticket->trip->tripPlan->route->carrier->name }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small"></i>{{ __('tickets.date') }}</div>
                        <div class="fw-medium fs-5">{{ $ticket->trip->date->format('d.m.Y') }}</div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-muted small">{{ __('admin_tickets.purchaser') }}</div>
                        <div class="fw-medium fs-5">{{ $ticket->user->phone }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">{{ __('admin_tickets.category') }}</div>
                        <div class="fw-medium fs-5 text-truncate" title="{{ $ticket->category->name }}">{{ $ticket->category->name }}</div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-muted small">{{ __('admin_tickets.price') }}</div>
                        <div class="fw-medium fs-5">{{ $ticket->price }} €</div>
                    </div>
                </div>

                <div class="row pt-3 border-top mb-4">
                    <div class="col-6 text-muted small">{{ __('admin_tickets.id') }}</div>
                    <div class="col-6 text-muted small font-monospace text-end text-truncate">{{ $ticket->id }}</div>
                    <div class="col-6 text-muted small">{{ __('admin_tickets.purchase_time') }}</div>
                    <div class="col-6 text-muted small font-monospace text-end">{{ $ticket->created_at->format('d.m.Y H:i') }}</div>
                </div>

                <div class="text-center">
                    @if($ticket->trashed())
                        <form method="POST" action="{{ route('admin.tickets.restore', $ticket->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger w-100 fw-bold py-2 shadow-sm">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>{{ __('admin_tickets.restore') }}
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.tickets.destroy', $ticket->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 fw-bold py-2 shadow-sm">
                                <i class="bi bi-trash3 me-1"></i>{{ __('admin_tickets.delete') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
<x-layouts.app>
    <x-slot name="title">
        {{ __('tickets.title') }}
    </x-slot>

    <div class="row justify-content-center my-2">
        <div class="col-md-9 col-lg-8">
            <h1 class="text-danger mb-4 fs-2"></i>{{ __('tickets.title') }}</h1>

            @if($tickets->isEmpty())
                <div class="card border-0 shadow-sm p-5 text-center">
                    <p class="text-muted m-0 fs-5">{{ __('tickets.empty') }}</p>
                </div>
            @else
                <div class="d-flex flex-column gap-4">
                    @foreach($tickets as $ticket)
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                                <span class="text-muted small fw-medium">
                                    <i class="bi bi-bus-front me-1 text-danger"></i> {{ $ticket->trip->tripPlan->route->carrier->name }}
                                </span>
                                <span class="text-muted small fw-medium">
                                    <i class="bi bi-calendar3 text-danger me-1"></i> {{ $ticket->trip->date->format('d.m.Y') }}
                                </span>
                                <span class="badge bg-danger text-white fw-bold">
                                    {{ __('trips.number') }} {{ $ticket->trip->tripPlan->route->number }} : {{ $ticket->trip->tripPlan->route->name }}
                                </span>
                            </div>

                            <div class="card border-0 shadow-sm p-4">
                                <div class="row align-items-center mx-1">
                                    <div class="col-md-4 text-center text-md-start">
                                        <div class="fs-3 fw-bold text-dark">
                                            {{ \Carbon\Carbon::parse($ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->from_stop_id)->departure_time)->format('H:i') }}
                                        </div>
                                        <div class="text-muted small text-truncate" title="{{ $ticket->tariff->fromStop->name }}">{{ $ticket->tariff->fromStop->name }}</div>
                                    </div>

                                    <div class="col-md-4 position-relative">
                                        <i class="bi bi-arrow-right text-danger position-absolute top-50 start-50 translate-middle bg-white px-2 fs-4" style="margin-top: -1px;"></i>
                                    </div>

                                    <div class="col-md-4 text-center text-md-end">
                                        <div class="fs-3 fw-bold text-dark">
                                            {{ \Carbon\Carbon::parse($ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->to_stop_id)->departure_time)->format('H:i') }}
                                        </div>
                                        <div class="text-muted small text-truncate" title="{{ $ticket->tariff->toStop->name }}">{{ $ticket->tariff->toStop->name }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2 px-1">
                                <div class="text-muted small">
                                    <i class="bi bi-tags text-danger me-1"></i>
                                    {{ __('tickets.category') }}: <span class="badge bg-secondary fw-medium">{{ $ticket->category->name }}</span>
                                </div>
                                
                                <div class="d-flex align-items-center gap-3">
                                    <span class="fs-4 fw-bold text-danger">{{ $ticket->price }} €</span>
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-outline-danger btn-sm fw-bold px-3">{{ __('tickets.view') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 d-flex justify-content-center">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
<x-layouts.app>
    <x-slot name="title">
        {{ __('tickets.view_title') }}
    </x-slot>

    <div class="mb-4 d-flex justify-content-center">
        <div class="col-md-10 col-lg-8 px-0">
            <a href="{{ route('tickets.index') }}" class="text-danger text-decoration-none fw-medium small">
                <i class="bi bi-arrow-left me-1"></i> {{ __('tickets.back') }}
            </a>
        </div>
    </div>

    <div class="row justify-content-center my-2">
        <div class="col-md-10 col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden position-relative">
                <div class="row g-0 align-items-stretch">
                    <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center p-4">{!! QrCode::size(160)->generate($ticket->id) !!}</div>

                    <div class="col-md-8 p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="mb-4">
                                <span class="text-muted small">{{ __('tickets.route') }}</span>
                                <div class="fs-3 fw-bold text-dark">{{ __('trips.number') }} {{ $ticket->trip->tripPlan->route->number }} : {{ $ticket->trip->tripPlan->route->name }}</div>
                            </div>

                            <div class="row bg-light rounded p-3 mb-4 mx-0 align-items-center text-center text-md-start">
                                <div class="col-md-5">
                                    <div class="text-muted small">
                                        <i class="bi bi-house-door text-danger me-1"></i>{{ __('tickets.from') }}
                                    </div>
                                    <div class="fw-bold fs-5 text-dark">{{ $ticket->tariff->fromStop->name }}</div>
                                    <span class="fs-5 fw-medium text-dark">
                                        {{ \Carbon\Carbon::parse($ticket->trip->tripPlan->stops->firstWhere('stop_id', $ticket->tariff->from_stop_id)->departure_time)->format('H:i') }}
                                    </span>
                                </div>
                                <div class="col-md-2 text-center text-muted fs-4">
                                    <i class="bi bi-arrow-right text-danger fs-4 d-none d-md-inline-block"></i>
                                    <i class="bi bi-arrow-down text-danger fs-4 d-inline-block d-md-none"></i>
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
                                    <div class="text-muted small">{{ __('tickets.date') }}</div>
                                    <div class="fw-medium fs-5 text-dark">{{ $ticket->trip->date->format('d.m.Y') }}</div>
                                </div>
                                <div class="col-6 text-end">
                                    <div class="text-muted small">{{ __('tickets.price') }}</div>
                                    <div class="fw-bold fs-2 text-danger text-nowrap">{{ $ticket->price }} €</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted small">{{ __('tickets.carrier') }} </div>
                                    <div class="fw-medium fs-5 text-dark">{{ $ticket->trip->tripPlan->route->carrier->name }}</div>
                                </div>
                                <div class="col-6 text-end">
                                    <div class="text-muted small">{{ __('tickets.category') }}</div>
                                    <div class="fw-medium fs-5 text-dark">{{ $ticket->category->name }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-end mt-3 pt-3 border-top">
                                <span class="text-muted small">{{ __('tickets.purchase_time') }}</span>
                                <span class="text-muted small font-monospace">{{ $ticket->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
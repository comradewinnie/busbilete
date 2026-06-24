<x-layouts.app>
    <x-slot name="title">
        {{ __('trips.show_title') }}
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('trips.index', ['from_stop_id' => $fromStop->id, 'to_stop_id' => $toStop->id, 'date' => $date]) }}" class="text-danger text-decoration-none fw-medium small">
            <i class="bi bi-arrow-left me-1"></i> {{ __('trips.back') }}
        </a>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-4 pb-2 gap-4 border-bottom">
        <div class="w-50">
            <span class="text-muted small fw-medium">{{ __('trips.carrier') }}</span>
            <h4 class="m-0 text-truncate" title="{{ $trip->tripPlan->route->carrier->name }}">{{ $trip->tripPlan->route->carrier->name }}</h4>
        </div>
        <div class="text-end">
            <span class="text-muted small fw-medium">{{ __('trips.date') }}</span>
            <h4 class="text-danger m-0">{{ $trip->date->format('d.m.Y') }}</h4>
        </div>
    </div>

    <div class="row g-4 g-md-5">
        <div class="col-md-5">
            <h3 class="text-danger mb-4 fs-4">{{ __('trips.stops') }}</h3>
            
            <div class="ps-4 ms-2">
                @foreach($stops as $stop)
                    @php
                        $isUserFrom = $stop->id === $fromStop->id;
                        $isUserTo = $stop->id === $toStop->id;
                        $stopTime = $trip->tripPlan->stops->firstWhere('stop_id', $stop->id)->departure_time;
                    @endphp
                    <div class="position-relative mb-4">
                        <div class="position-absolute rounded-circle bg-white border border-danger" style="width: 14px; height: 14px; left: -32px; top: 6px; border-width: 3px !important; {{ $isUserFrom || $isUserTo ? 'background-color: #dc3545 !important;' : '' }}"></div>
                        
                        <div class="d-flex justify-content-between align-items-baseline gap-4">
                            <span class="text-truncate fs-5 {{ $isUserFrom || $isUserTo ? 'text-danger fw-bold' : 'text-dark fw-medium' }}" title="{{ $stop->name }}">{{ $stop->name }}</span>
                            <span class="text-muted {{ $isUserFrom || $isUserTo ? 'fw-bold' : '' }}">{{ \Carbon\Carbon::parse($stopTime)->format('H:i') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-7">
            <h3 class="text-danger mb-4 fs-4">{{ __('trips.your_route') }}</h3>

            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="mb-4">
                    <span class="text-muted small">{{ __('trips.route') }}</span>
                    <div class="fs-3 fw-bold text-dark">{{ __('trips.number') }} {{ $trip->tripPlan->route->number }} : {{ $trip->tripPlan->route->name }}</div>
                </div>

                <div class="row bg-light rounded p-3 mb-4 mx-0 align-items-center">
                    <div class="col-md-5">
                        <div class="text-muted small">
                            <i class="bi bi-house-door text-danger me-1"></i>{{ __('trips.from') }}
                        </div>
                        <div class="fw-bold fs-5 text-dark">{{ $fromStop->name }}</div>
                    </div>
                    <div class="col-md-2 text-center text-muted fs-4">
                        <i class="bi bi-arrow-right text-danger d-none d-md-block"></i>
                        <i class="bi bi-arrow-down text-danger d-block d-md-none"></i>
                    </div>
                    <div class="col-md-5 text-md-end">
                        <div class="text-muted small">
                            <i class="bi bi-geo-alt text-danger me-1"></i>{{ __('trips.to') }}
                        </div>
                        <div class="fw-bold fs-5 text-dark">{{ $toStop->name }}</div>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-6">
                        <div class="text-muted small">
                            <i class="bi bi-person-workspace text-danger me-1"></i>{{ __('trips.seats_2') }}
                        </div>
                        <div class="fw-bold fs-5 text-dark">{{ $availableSeats }} / {{ $trip->bus->number_of_seats }}</div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-muted small">{{ __('trips.price') }}</div>
                        <div class="fw-bold fs-2 text-danger text-nowrap">{{ $tariff->price }} €</div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 mt-2">
                    @auth
                        @if($availableSeats > 0)
                            <form method="POST" action="{{ route('cart.add') }}" class="w-100">
                                @csrf
                                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                                <input type="hidden" name="tariff_id" value="{{ $tariff->id }}">
                                <button type="submit" class="btn btn-danger w-100 fw-bold py-2 fs-5 shadow-sm">
                                    <i class="bi bi-cart-plus me-2"></i>{{ __('trips.add_cart') }}
                                </button>
                            </form>
                        @else
                            <div class="alert bg-light text-center border-0 my-1">{{ __('trips.no_seats') }}</div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-danger w-100 fw-bold py-2 fs-5">
                            <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('trips.login') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
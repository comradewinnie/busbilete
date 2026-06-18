<x-layouts.app>
    <x-slot name="title">
        {{ __('trips.title') }}
    </x-slot>

    <div class="row g-5 my-2">
        <div class="col-md-4">
            <div class="card border-0 sticky-top" style="top: 20px; z-index: 1020;">
                <x-searchbar :stops="$stops" />
                @auth
                    @php
                        $favorite = auth()->user()->favoriteRoutes
                            ->where('from_stop_id', $fromStop->id)
                            ->where('to_stop_id', $toStop->id)
                            ->first();
                    @endphp

                    @if($favorite)
                        <form method="POST" action="{{ route('favorites.destroy', $favorite->id) }}" class="w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100 fw-bold py-2 btn-sm mt-2">
                                <i class="bi bi-heart-fill text-danger me-2"></i>{{ __('trips.unfavorite') }}
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('favorites.store') }}" class="w-100">
                            @csrf
                            <input type="hidden" name="from_stop_id" value="{{ $fromStop->id }}">
                            <input type="hidden" name="to_stop_id" value="{{ $toStop->id }}">
                            <button type="submit" class="btn btn-outline-danger w-100 fw-bold py-2 btn-sm mt-2">
                                <i class="bi bi-heart me-2"></i>{{ __('trips.favorite') }}
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>

        <div class="col-md-8">
            <h1 class="fw-bold text-danger mb-4 fs-2">{{ __('trips.title') }}</h1>

            @if($trips->isEmpty())
                <div class="card border-0 shadow-sm p-4 text-center">
                    <p class="text-muted my-3 fs-5">{{ __('trips.not_found') }}</p>
                </div>
            @else
                <div class="d-flex flex-column gap-4">
                    @foreach($trips as $trip)
                        @php
                            $fromStop = $trip->tripPlan->stops->firstWhere('stop_id', request('from_stop_id'));
                            $toStop = $trip->tripPlan->stops->firstWhere('stop_id', request('to_stop_id'));
                            $tariff = $trip->tripPlan->route->tariffs->where('from_stop_id', request('from_stop_id'))
                                ->where('to_stop_id', request('to_stop_id'))
                                ->where('status', 'active')
                                ->first();
                        @endphp

                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                                <span class="text-muted small fw-medium">
                                    <i class="bi bi-bus-front me-1 text-danger"></i> {{ $trip->tripPlan->route->carrier->name }}
                                </span>
                                <span class="badge bg-danger text-white fw-bold">{{ __('trips.number') }} {{ $trip->tripPlan->route->number }} : {{ $trip->tripPlan->route->name }}</span>
                            </div>

                            <div class="card border-0 shadow-sm p-4">
                                <div class="row align-items-center text-center text-md-start">
                                    <div class="col-md-4">
                                        <div class="fs-3 fw-bold text-dark">{{ \Carbon\Carbon::parse($fromStop->departure_time)->format('H:i') }}</div>
                                        <div class="text-muted small text-truncate" title="{{ $fromStop->stop->name }}">{{ $fromStop->stop->name }}</div>
                                    </div>

                                    <div class="col-md-4">
                                        <i class="bi bi-arrow-right text-danger position-absolute top-50 start-50 translate-middle bg-white px-2 fs-4" style="margin-top: -1px;"></i>
                                    </div>

                                    <div class="col-md-4 text-md-end">
                                        <div class="fs-3 fw-bold text-dark">{{ \Carbon\Carbon::parse($toStop->departure_time)->format('H:i') }}</div>
                                        <div class="text-muted small text-truncate" title="{{ $toStop->stop->name }}">{{ $toStop->stop->name }}</div>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2 px-1">
                                <div class="text-muted small">
                                    <i class="bi bi-person-workspace text-danger me-1"></i> 
                                    {{ __('trips.seats') }}: <span class="fw-bold text-dark">{{ $trip->available_seats }}</span>
                                </div>
                                
                                <div class="d-flex align-items-center gap-3">
                                    <span class="fs-4 fw-bold text-danger">{{ $tariff->price }} €</span>
                                    <a href="{{ route('trips.show', ['trip' => $trip->id, 'from_stop_id' => request('from_stop_id'), 'to_stop_id' => request('to_stop_id'), 'date' => request('date')]) }}" class="btn btn-outline-danger btn-sm fw-bold px-3">{{ __('trips.view') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
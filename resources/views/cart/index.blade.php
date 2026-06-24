<x-layouts.app>
    <x-slot name="title">
        {{ __('cart.title') }}
    </x-slot>

    <h1 class="fw-bold text-danger mb-4 fs-2">{{ __('cart.title') }}</h1>

    @if(empty($items))
        <div class="card border-0 shadow-sm p-5 text-center">
            <p class="text-muted m-0 fs-5">{{ __('cart.empty') }}</p>
        </div>
    @else
        <div class="row g-4 g-lg-5">
            <div class="col-md-8">
                <div class="d-flex flex-column gap-4">
                    @foreach($items as $key => $item)
                        <div>
                            <div class="d-flex justify-content-between align-items-center gap-4 mb-2 px-1">
                                <div class="d-flex gap-2 flex-wrap">
                                    <span class="badge bg-danger text-white fw-bold text-wrap text-start">
                                        {{ __('trips.number') }} {{ $item['trip']->tripPlan->route->number }} : {{ $item['trip']->tripPlan->route->name }}
                                    </span>
                                    <span class="text-muted small fw-medium">
                                        <i class="bi bi-bus-front me-1 text-danger"></i> {{ $item['trip']->tripPlan->route->carrier->name }}
                                    </span>
                                </div>
                                <span class="text-muted small text-nowrap fw-medium">
                                    <i class="bi bi-calendar3 text-danger me-1"></i> {{ $item['trip']->date->format('d.m.Y') }}
                                </span>
                            </div>

                            <div class="card border-0 shadow-sm p-4">
                                <div class="row align-items-center text-center text-md-start g-3">
                                    <div class="col-4 col-md-4 text-start">
                                        <div class="fs-4 fw-bold text-dark">{{ \Carbon\Carbon::parse($item['trip']->tripPlan->stops->firstWhere('stop_id', $item['tariff']->from_stop_id)->departure_time)->format('H:i') }}</div>
                                        <div class="text-muted small text-truncate" title="{{ $item['tariff']->fromStop->name }}">{{ $item['tariff']->fromStop->name }}</div>
                                    </div>

                                    <div class="col-4 col-md-4 text-center">
                                        <i class="bi bi-arrow-right text-danger"></i>
                                    </div>

                                    <div class="col-4 col-md-4 text-end">
                                        <div class="fs-4 fw-bold text-dark">{{ \Carbon\Carbon::parse($item['trip']->tripPlan->stops->firstWhere('stop_id', $item['tariff']->to_stop_id)->departure_time)->format('H:i') }}</div>
                                        <div class="text-muted small text-truncate" title="{{ $item['tariff']->toStop->name }}">{{ $item['tariff']->toStop->name }}</div>
                                    </div>
                                </div>

                                <hr class="text-muted my-3 opacity-25">

                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-3">
                                    <div class="d-flex align-items-center gap-2 flex-grow-1">
                                        <label class="text-muted small text-nowrap fw-medium m-0">{{ __('cart.category') }}:</label>
                                        <form method="POST" action="{{ route('cart.updateCategory', $key) }}" class="w-100 m-0">
                                            @csrf
                                            @method('PATCH')
                                            <select name="ticket_category_id" onchange="this.form.submit()" class="form-select form-select-sm">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $item['category']->id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between justify-content-md-end gap-3 flex-shrink-0">
                                        <span class="fs-4 fw-bold text-dark">{{ number_format($item['price'], 2) }} €</span>
                                        <form method="POST" action="{{ route('cart.remove', $key) }}" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-danger text-decoration-none" title="{{ __('cart.remove') }}">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 p-4 sticky-top mt-2 mt-md-0" style="top: 20px; z-index: 1020;">
                    <h3 class="fw-bold text-dark mb-4 fs-4 border-bottom pb-2">{{ __('cart.order') }}</h3>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted fw-medium">{{ __('cart.total') }}:</span>
                        <span class="fs-3 fw-bold text-danger">{{ number_format(collect($items)->sum('price'), 2) }} €</span>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <form method="POST" action="{{ route('checkout.create') }}" class="w-100 m-0">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100 fw-bold py-2 fs-5 shadow-sm">
                                <i class="bi bi-credit-card me-2"></i>{{ __('cart.checkout') }}
                            </button>
                        </form>

                        <a href="{{ route('home') }}" class="btn btn-outline-danger w-100 fw-bold btn-sm py-2 text-center">{{ __('cart.continue') }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-layouts.app>
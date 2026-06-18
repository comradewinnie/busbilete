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
        <div class="row g-5">
            <div class="col-md-8">
                <div class="d-flex flex-column gap-4">
                    @foreach($items as $key => $item)
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                                <span class="text-muted small fw-medium">
                                    <i class="bi bi-bus-front me-1 text-danger"></i> {{ $item['trip']->tripPlan->route->carrier->name }}
                                </span>
                                <span class="text-muted small fw-medium">
                                    <i class="bi bi-calendar3 text-danger me-1"></i> {{ $item['trip']->date->format('d.m.Y') }}
                                </span>
                                <span class="badge bg-danger text-white fw-bold">{{ __('trips.number') }} {{ $item['trip']->tripPlan->route->number }} : {{ $item['trip']->tripPlan->route->name }}</span>
                            </div>

                            <div class="card border-0 shadow-sm p-4 position-relative">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="fs-4 fw-bold text-dark">{{ \Carbon\Carbon::parse($item['trip']->tripPlan->stops->firstWhere('stop_id', $item['tariff']->from_stop_id)->departure_time)->format('H:i') }}</div>
                                        <div class="text-muted small text-truncate" title="{{ $item['tariff']->fromStop->name }}">{{ $item['tariff']->fromStop->name }}</div>
                                    </div>

                                    <div class="col-md-4 position-relative">
                                        <i class="bi bi-arrow-right text-danger position-absolute top-50 start-50 translate-middle bg-white px-2 fs-4" style="margin-top: -1px;"></i>
                                    </div>

                                    <div class="col-md-4 text-md-end">
                                        <div class="fs-4 fw-bold text-dark">{{ \Carbon\Carbon::parse($item['trip']->tripPlan->stops->firstWhere('stop_id', $item['tariff']->to_stop_id)->departure_time)->format('H:i') }}</div>
                                        <div class="text-muted small text-truncate" title="{{ $item['tariff']->toStop->name }}">{{ $item['tariff']->toStop->name }}</div>
                                    </div>
                                </div>

                                <hr class="text-muted my-3 opacity-25">

                                <div class="d-flex justify-content-between align-items-center text-nowrap gap-3">
                                    <div class="d-flex align-items-center gap-2" style="max-width: 650px;">
                                        <label class="text-muted small text-nowrap fw-medium">{{ __('cart.category') }}:</label>
                                        <form method="POST" action="{{ route('cart.updateCategory', $key) }}" class="w-100">
                                            @csrf
                                            @method('PATCH')
                                            <select name="ticket_category_id" onchange="this.form.submit()" class="form-select form-select-sm">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $item['category']->id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>

                                    <div class="d-flex align-items-center gap-3">
                                        <span class="fs-4 fw-bold text-dark">{{ number_format($item['price'], 2) }} €</span>
                                        <form method="POST" action="{{ route('cart.remove', $key) }}">
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
                <div class="card border-0 sticky-top" style="top: 20px; z-index: 1020;">
                    <h3 class="fw-bold text-dark mb-4 fs-4 border-bottom pb-2">{{ __('cart.order') }}</h3>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted fw-medium">{{ __('cart.total') }}:</span>
                        <span class="fs-3 fw-bold text-danger">{{ number_format(collect($items)->sum('price'), 2) }} €</span>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <form method="POST" action="{{ route('checkout.create') }}" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100 fw-bold py-2 fs-5 shadow-sm">
                                <i class="bi bi-credit-card me-2"></i>{{ __('cart.checkout') }}
                            </button>
                        </form>

                        <a href="{{ route('home') }}" class="btn btn-outline-danger w-100 fw-bold btn-sm py-2">{{ __('cart.continue') }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-layouts.app>
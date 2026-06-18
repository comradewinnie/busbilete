<x-layouts.app>
    <x-slot name="title">
        {{ __('favorites.title') }}
    </x-slot>

    <h1 class="fw-bold text-danger mb-4 fs-2">{{ __('favorites.title') }}</h1>

    @if($favorites->isEmpty())
        <div class="card border-0 shadow-sm p-5 text-center">
            <p class="text-muted m-0 fs-5">{{ __('favorites.empty') }}</p>
        </div>
    @else
        <div class="row g-4 my-2">
            @foreach($favorites as $favorite)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm p-4">
                        <div class="mb-3">
                            <div class="row align-items-center text-center">
                                <div class="col-5">
                                    <span class="text-muted small">{{ __('favorites.from') }}</span>
                                    <span class="fw-bold text-dark small text-truncate d-block" title="{{ $favorite->fromStop->name }}">{{ $favorite->fromStop->name }}</span>
                                </div>
                                <div class="col-2 p-0 text-muted">
                                    <i class="bi bi-arrow-right fs-6 text-danger"></i>
                                </div>
                                <div class="col-5">
                                    <span class="text-muted small">{{ __('favorites.to') }}</span>
                                    <span class="fw-bold text-dark small text-truncate d-block" title="{{ $favorite->toStop->name }}">{{ $favorite->toStop->name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-auto pt-3 border-top">
                            <form method="POST" action="{{ route('favorites.destroy', $favorite->id) }}" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-muted p-0" title="{{ __('favorites.remove') }}">
                                    <i class="bi bi-trash3 fs-5 text-danger"></i>
                                </button>
                            </form>

                            <a href="{{ route('trips.index', ['from_stop_id' => $favorite->from_stop_id, 'to_stop_id' => $favorite->to_stop_id, 'date' => date('Y-m-d')]) }}" class="btn btn-outline-danger btn-sm fw-bold px-3">{{ __('favorites.search') }}</a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layouts.app>
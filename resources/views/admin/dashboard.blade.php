<x-layouts.app>
    <x-slot name="title">
        {{ __('dashboard.title') }}
    </x-slot>

    <div class="row justify-content-center my-5">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 p-4 text-center ">
                <h1 class="fw-bold text-danger fs-2 mb-4">{{ __('dashboard.title') }}</h1>

                <div class="d-flex flex-column gap-2 mb-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-danger w-100 fw-bold py-2">
                        <i class="bi bi-people me-2"></i>{{ __('dashboard.users') }}
                    </a>
                    
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-danger w-100 fw-bold py-2">
                        <i class="bi bi-ticket-detailed me-2"></i>{{ __('dashboard.tickets') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
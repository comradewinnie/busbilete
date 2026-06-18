<x-layouts.app>
    <x-slot name="title">
        {{ __('profile.title') }}
    </x-slot>

    <div class="row justify-content-center my-5">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 p-4 text-center shadow-sm">
                <div class="d-inline-flex align-items-center justify-content-center bg-danger text-white rounded-circle mb-3 mx-auto" style="width: 80px; height: 80px;">
                    <i class="bi bi-person-fill fs-1"></i>
                </div>

                <h1 class="fw-bold text-danger fs-2 my-0">{{ __('profile.title') }}</h1>

                <div class="row bg-light rounded p-3 my-4 align-items-center justify-content-between g-3">
                    <div class="col-sm-6 mt-0 text-center text-sm-start">
                        <div class="text-muted small">
                            <i class="bi bi-telephone text-danger me-1"></i>{{ __('profile.phone') }}
                        </div>
                        <div class="fw-medium fs-5 text-dark">{{ $user->phone }}</div>
                    </div>
                    <div class="col-sm-6 mt-0 text-center text-sm-end">
                        <div class="text-muted small">
                            <i class="bi bi-calendar-check me-1 text-danger"></i>{{ __('profile.since') }}
                        </div>
                        <div class="fw-medium fs-5 text-dark">{{ $user->created_at->format('d.m.Y') }}</div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 mb-2">
                    <a href="{{ route('profile.edit') }}" class="btn btn-danger w-100 fw-bold py-2 shadow-sm">
                        <i class="bi bi-pencil-square me-2"></i>{{ __('profile.edit') }}
                    </a>
                </div>

                <div class="text-center">
                    <form method="POST" action="{{ route('profile.destroy') }}" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger fw-bold py-2 btn-sm w-100" onclick="return confirm('{{ __('profile.confirm_delete') }}')">{{ __('profile.delete') }}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
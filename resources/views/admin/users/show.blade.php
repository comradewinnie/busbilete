<x-layouts.app>
    <x-slot name="title">
        {!! __('admin_users.title_2', ['phone' => $user->phone]) !!}
    </x-slot>

    <div class="mb-4 d-flex justify-content-center">
        <div class="col-md-8 col-lg-5">
            <a href="{{ route('admin.users.index') }}" class="text-danger text-decoration-none fw-medium small">
                <i class="bi bi-arrow-left me-1"></i> {{ __('admin_users.back') }}
            </a>
        </div>
    </div>

    <div class="row justify-content-center my-2">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 p-4 text-center shadow-sm">
                <div class="d-inline-flex align-items-center justify-content-center bg-danger text-white rounded-circle mb-3 mx-auto" style="width: 80px; height: 80px;">
                    <i class="bi bi-person-fill fs-1"></i>
                </div>

                <h1 class="fw-bold text-danger fs-2 my-0">{!! __('admin_users.title_2', ['phone' => $user->phone]) !!}</h1>

                <div class="row bg-light rounded p-3 my-4 align-items-center">
                    <div class="col-sm-6 mt-0 text-center text-sm-start">
                        <div class="text-muted small">
                            <i class="bi bi-calendar-check me-1 text-danger"></i>{{ __('admin_users.since') }}
                        </div>
                        <div class="fw-medium fs-5 text-dark">{{ $user->created_at->format('d.m.Y') }}</div>
                    </div>
                    
                    <div class="col-sm-6 mt-0 text-center text-sm-end">
                        <div class="text-muted small">
                            <i class="bi bi-person-badge me-1 text-danger"></i>{{ __('admin_users.role') }}
                        </div>
                        <div class="badge {{ $user->isAdmin() ? 'bg-danger' : 'bg-secondary' }} px-2 py-1 fw-medium">{{ $user->role }}</div>
                    </div>
                </div>

                <div class="text-center">
                    @if($user->trashed())
                        <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger w-100 fw-bold py-2 shadow-sm">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>{{ __('admin_users.restore') }}
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 fw-bold py-2 shadow-sm">
                                <i class="bi bi-trash3 me-1"></i>{{ __('admin_users.delete') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
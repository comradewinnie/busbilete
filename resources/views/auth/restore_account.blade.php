<x-layouts.app>
    <x-slot name="title">
        {{ __('auth.restore_title') }}
    </x-slot>

    <div class="row justify-content-center my-5">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 p-4 text-center">
                <h1 class="fw-bold text-danger fs-2 mb-4">{{ __('auth.restore_title') }}</h1>

                <div class="bg-light rounded p-3 mb-4">
                    <p class="text-dark fw-medium mb-2">{!! __('auth.restore_account_deleted', ['phone' => $user->phone]) !!}</p>
                    <p class="text-danger fw-bold mb-2">{!! trans_choice('auth.restore_days_left', $daysLeft, ['days' => $daysLeft]) !!}</p>
                    <p class="mb-0 text-muted">{{ __('auth.restore_warning') }}</p>
                </div>

                <div class="d-flex flex-column gap-2">
                    <form action="{{ route('account.restore') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 fw-bold py-2 shadow-sm">{{ __('auth.restore') }}</button>
                    </form>

                    <form action="{{ route('account.restore.cancel') }}" method="POST" class="m-0 flex-grow-1">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger fw-bold py-2 btn-sm w-100">{{ __('auth.cancel') }}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
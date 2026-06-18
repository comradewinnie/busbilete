<x-layouts.app>
    <x-slot name="title">
        {{ __('profile.edit') }}
    </x-slot>

    <div class="row justify-content-center my-4">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 p-4">
                <h2 class="text-center mb-4 fw-bold text-danger">{{ __('profile.edit') }}</h2>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-medium">{{ __('profile.phone_number') }}</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-medium">{{ __('profile.current_pass') }}</label>
                        <input type="password" id="current_password" name="current_password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-medium">{{ __('profile.new_pass') }}</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-medium">{{ __('profile.confirm_pass') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-danger w-100 fw-bold">{{ __('profile.save') }}</button>
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-danger fw-bold py-2 btn-sm w-100">{{ __('profile.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
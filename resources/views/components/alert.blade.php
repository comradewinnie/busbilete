@if(session('success'))
    <div class="alert alert-success border-0 mb-4" role="alert">
        <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger border-0 mb-4" role="alert">
        <i class="bi bi-exclamation-triangle me-1"></i>{{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger border-0 mb-4" role="alert">
        <div class="d-flex align-items-start">
            <i class="bi bi-exclamation-circle me-1"></i>
            <div class="w-100">
                @if($errors->count() === 1)
                    {{ $errors->first() }}
                @else
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endif
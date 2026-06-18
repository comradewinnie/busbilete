<form method="GET" action="{{ route('trips.index') }}">
    <div class="mb-3">
        <label for="from_stop_id" class="form-label fw-medium">
            <i class="bi bi-house-door text-danger me-1"></i>{{ __('searchbar.from') }}
        </label>
        <select name="from_stop_id" id="from_stop_id" class="form-select" required>
            <option value="">{{ __('searchbar.select') }}</option>
            @foreach($stops as $stop)
                <option value="{{ $stop->id }}" {{ old('from_stop_id', request('from_stop_id')) == $stop->id ? 'selected' : '' }}>
                    {{ $stop->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="to_stop_id" class="form-label fw-medium">
            <i class="bi bi-geo-alt text-danger me-1"></i>{{ __('searchbar.to') }}
        </label>
        <select name="to_stop_id" id="to_stop_id" class="form-select" required>
            <option value="">{{ __('searchbar.select') }}</option>
            @foreach($stops as $stop)
                <option value="{{ $stop->id }}" {{ old('to_stop_id', request('to_stop_id')) == $stop->id ? 'selected' : '' }}>
                    {{ $stop->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="date" class="form-label fw-medium">
            <i class="bi bi-calendar3 text-danger me-1"></i>{{ __('searchbar.date') }}
        </label>
        <input type="date" id="date" name="date" value="{{ old('date', request('date', date('Y-m-d'))) }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-danger w-100 fw-bold py-2 fs-5">
        <i class="bi bi-search me-2"></i>{{ __('searchbar.search') }}
    </button>
</form>
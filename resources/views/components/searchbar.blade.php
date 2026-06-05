<form method="GET" action="{{ route('trips.index') }}">
        <div>
            <label for="from_stop_id">No</label>
            <select name="from_stop_id" id="from_stop_id" required>
                <option value="">— izvēlieties —</option>
                @foreach($stops as $stop)
                    <option value="{{ $stop->id }}" {{ old('from_stop_id', request('from_stop_id')) == $stop->id ? 'selected' : '' }}>{{ $stop->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="to_stop_id">Līdz</label>
            <select name="to_stop_id" id="to_stop_id" required>
                <option value="">— izvēlieties —</option>
                @foreach($stops as $stop)
                    <option value="{{ $stop->id }}" {{ old('to_stop_id', request('to_stop_id')) == $stop->id ? 'selected' : '' }}>{{ $stop->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="date">Datums</label>
            <!-- <input type="date" id="date" name="date" min="{{ date('Y-m-d') }}" value="{{ old('date', request('date')) }}" required> – for real application --> 
            <input type="date" id="date" name="date" value="{{ old('date', request('date')) }}" required>
        </div>

        <button type="submit">Meklēt</button>
</form>
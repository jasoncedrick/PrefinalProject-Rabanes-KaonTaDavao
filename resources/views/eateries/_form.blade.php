@csrf
@include('partials.errors')
<div>
    <label>Eatery name
        <input type="text" name="name" value="{{ old('name', $eatery->name) }}">
    </label>
    @error('name') <p class="error">{{ $message }}</p> @enderror
</div>
<div>
    <label>District
        <select name="district_id">
            <option value="">Choose a district</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id) == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>
    </label>
    @error('district_id') <p class="error">{{ $message }}</p> @enderror
</div>
<div>
    <label>Address
        <input type="text" name="address" value="{{ old('address', $eatery->address) }}">
    </label>
    @error('address') <p class="error">{{ $message }}</p> @enderror
</div>
<div>
    <label>Price range
        <select name="price_range">
            <option value="">Choose a price range</option>
            @foreach (['budget' => 'Budget (₱)', 'mid' => 'Mid (₱₱)', 'splurge' => 'Splurge (₱₱₱)'] as $value => $label)
                <option value="{{ $value }}" @selected(old('price_range', $eatery->price_range) === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </label>
    @error('price_range') <p class="error">{{ $message }}</p> @enderror
</div>
<div>
    <label>Specialty (optional)
        <input type="text" name="specialty" value="{{ old('specialty', $eatery->specialty) }}">
    </label>
    @error('specialty') <p class="error">{{ $message }}</p> @enderror
</div>
<div>
    <input type="hidden" name="is_open" value="0">
    <label><input type="checkbox" name="is_open" value="1" @checked(old('is_open', $eatery->is_open))> Open</label>
    @error('is_open') <p class="error">{{ $message }}</p> @enderror
</div>
<fieldset>
    <legend>Features</legend>
    @php
        $selectedFeatures = session()->hasOldInput() ? (array) old('features', []) : ($eatery->exists ? $eatery->features->modelKeys() : []);
    @endphp
    <div class="mt-1 flex flex-wrap gap-4">
        @foreach ($features as $feature)
            <label><input type="checkbox" name="features[]" value="{{ $feature->id }}" @checked(in_array($feature->id, $selectedFeatures))> {{ $feature->name }}</label>
        @endforeach
    </div>
    @error('features') <p class="error">{{ $message }}</p> @enderror
    @error('features.*') <p class="error">{{ $message }}</p> @enderror
</fieldset>
<div>
    <label>Permit number
        <input type="text" name="permit_no" value="{{ old('permit_no', $eatery->exists ? $eatery->permit->permit_no : '') }}">
    </label>
    @error('permit_no') <p class="error">{{ $message }}</p> @enderror
</div>
<div>
    <label>Permit expiry date
        <input type="date" name="expires_on" value="{{ old('expires_on', $eatery->exists ? $eatery->permit->expires_on->format('Y-m-d') : '') }}">
    </label>
    @error('expires_on') <p class="error">{{ $message }}</p> @enderror
</div>
<button type="submit">Save eatery</button>

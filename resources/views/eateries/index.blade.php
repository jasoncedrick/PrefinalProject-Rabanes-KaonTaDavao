@extends('layouts.app')

@section('content')
<h1>Eateries</h1>
<form method="GET" action="{{ route('eateries.index') }}" class="panel grid items-end gap-4 md:grid-cols-4">
    <label>Name or specialty
        <input type="search" name="q" value="{{ request('q') }}">
    </label>
    <label>District
        <select name="district">
            <option value="">All districts</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(request('district') == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>
    </label>
    <label>Feature
        <select name="feature">
            <option value="">All features</option>
            @foreach ($features as $feature)
                <option value="{{ $feature->name }}" @selected(request('feature') === $feature->name)>{{ $feature->name }}</option>
            @endforeach
        </select>
    </label>
    <button>Filter eateries</button>
</form>
<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    @forelse ($eateries as $eatery)
        <x-eatery-card :eatery="$eatery" />
    @empty
        <p>No eateries match your filters.</p>
    @endforelse
</div>
{{ $eateries->links() }}
@endsection

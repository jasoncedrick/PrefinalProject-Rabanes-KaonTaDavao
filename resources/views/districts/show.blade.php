@extends('layouts.app')

@section('content')
<h1>{{ $district->name }}</h1>
<p>{{ $district->reviews_count }} {{ Str::plural('review', $district->reviews_count) }} in {{ $district->name }}</p>
<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    @forelse ($eateries as $eatery)
        <x-eatery-card :eatery="$eatery" />
    @empty
        <p>No eateries in this district yet.</p>
    @endforelse
</div>
@endsection

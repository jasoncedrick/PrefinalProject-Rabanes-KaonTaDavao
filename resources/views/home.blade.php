@extends('layouts.app')

@section('content')
<h1>Kaon Ta! Davao</h1>
<div class="flex flex-wrap gap-6 rounded-lg bg-green-900 p-5 text-white">
    <p>{{ $eateryCount }} eateries</p>
    <p>{{ $districtCount }} districts</p>
    <p>{{ $reviewCount }} reviews</p>
</div>
<h2>Top Rated</h2>
<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    @forelse ($topRated as $eatery)
        <x-eatery-card :eatery="$eatery" />
    @empty
        <p>No rated eateries yet.</p>
    @endforelse
</div>
@endsection

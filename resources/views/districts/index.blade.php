@extends('layouts.app')

@section('content')
<h1>Districts</h1>
<ul class="panel divide-y">
    @foreach ($districts as $district)
        <li class="flex justify-between py-3">
            <a href="{{ route('districts.show', $district) }}">{{ $district->name }}</a>
            <span>{{ $district->eateries_count }} {{ Str::plural('eatery', $district->eateries_count) }}</span>
        </li>
    @endforeach
</ul>
@endsection

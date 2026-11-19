@extends('layouts.app')

@section('content')
<h1>{{ $user->name }}</h1>
<p>{{ $reviews->count() }} {{ Str::plural('review', $reviews->count()) }} written</p>
@foreach ($reviews as $review)
    <article class="panel">
        <h2><a href="{{ route('eateries.show', $review->eatery) }}">{{ $review->eatery->name }}</a></h2>
        <x-rating :value="$review->rating" />
        <p>{{ $review->body }}</p>
    </article>
@endforeach
@endsection

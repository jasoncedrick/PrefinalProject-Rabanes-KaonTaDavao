@extends('layouts.app')

@section('content')
<h1>{{ $eatery->name }}</h1>
<section class="panel space-y-2">
    <p><a href="{{ route('districts.show', $eatery->district) }}">{{ $eatery->district->name }}</a> · {{ $eatery->address }}</p>
    <p>{{ ucfirst($eatery->price_range) }} · {{ $eatery->is_open ? 'Open' : 'Closed' }}</p>
    <p>Specialty: {{ $eatery->specialty ?? 'Unlisted' }}</p>
    @include('partials.features')
    <div class="flex items-center gap-4">
        <a href="{{ route('eateries.edit', $eatery) }}">Edit eatery</a>
        <form method="POST" action="{{ route('eateries.destroy', $eatery) }}">
            @csrf
            @method('DELETE')
            <button class="bg-red-800">Delete eatery</button>
        </form>
    </div>
</section>
<section class="panel">
    <h2>Business permit</h2>
    <p>{{ $eatery->permit->permit_no }} · Expires {{ $eatery->permit->expires_on->format('M j, Y') }}</p>
    @if ($eatery->permit->expires_on->lt(today()))
        <p class="text-red-700">Permit expired</p>
    @endif
</section>
<section class="panel">
    <h2>Dishes</h2>
    <ul class="divide-y">
        @forelse ($eatery->dishes as $dish)
            <li class="flex justify-between py-2">
                <span>{{ $dish->name }} @if ($dish->is_bestseller) <span class="badge">Bestseller</span> @endif</span>
                <span>₱{{ number_format($dish->price, 2) }}</span>
            </li>
        @empty
            <li>No dishes listed yet.</li>
        @endforelse
    </ul>
</section>
<section class="panel space-y-3">
    <h2>Reviews</h2>
    @forelse ($eatery->reviews as $review)
        <article class="space-y-1 border-t pt-3">
            <a href="{{ route('reviewers.show', $review->user) }}">{{ $review->user->name }}</a>
            <x-rating :value="$review->rating" />
            <time datetime="{{ $review->created_at->toDateString() }}">{{ $review->created_at->format('M j, Y') }}</time>
            <p>{{ $review->body }}</p>
            <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                @csrf
                @method('DELETE')
                <button class="bg-red-800">Delete review</button>
            </form>
        </article>
    @empty
        <p>No reviews yet</p>
    @endforelse
</section>
@if ($eatery->is_open)
    <form class="panel max-w-2xl space-y-4" method="POST" action="{{ route('eateries.reviews.store', $eatery) }}">
        @csrf
        <h2>Write a review</h2>
        @include('partials.errors')
        <div>
            <label>Reviewer
                <select name="user_id">
                    <option value="">Choose a reviewer</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </label>
            @error('user_id') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Rating
                <select name="rating">
                    <option value="">Choose a rating</option>
                    @foreach (range(1, 5) as $rating)
                        <option value="{{ $rating }}" @selected(old('rating') == $rating)>{{ $rating }} ★</option>
                    @endforeach
                </select>
            </label>
            @error('rating') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Review <textarea name="body" rows="3">{{ old('body') }}</textarea></label>
            @error('body') <p class="error">{{ $message }}</p> @enderror
        </div>
        <button>Post review</button>
    </form>
@else
    <p>This eatery is closed. Reviews are paused.</p>
@endif
@endsection

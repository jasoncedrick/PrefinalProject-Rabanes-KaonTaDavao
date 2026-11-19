@props(['eatery'])
<article class="panel space-y-2">
    <a href="{{ route('districts.show', $eatery->district) }}">{{ $eatery->district->name }}</a>
    <h3><a href="{{ route('eateries.show', $eatery) }}">{{ $eatery->name }}</a></h3>
    <p>{{ ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'][$eatery->price_range] }}
        @if (!$eatery->is_open) <span class="badge">Closed</span> @endif
    </p>
    <p>{{ $eatery->specialty }}</p>
    @include('partials.features')
    <x-rating :value="$eatery->reviews_avg_rating" :count="$eatery->reviews_count" />
</article>

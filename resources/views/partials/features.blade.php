<div class="flex flex-wrap gap-2">
    @foreach ($eatery->features as $feature)
        <a class="badge" href="{{ route('eateries.index', ['feature' => $feature->name]) }}">{{ $feature->name }}</a>
    @endforeach
</div>

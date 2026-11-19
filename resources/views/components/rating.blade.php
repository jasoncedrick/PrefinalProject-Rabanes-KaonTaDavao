@props(['value', 'count' => null])
@if ($count === 0)
    <span>No reviews yet</span>
@elseif ($count !== null)
    <span>{{ number_format($value, 1) }} ★ ({{ $count }} {{ Str::plural('review', $count) }})</span>
@else
    <span aria-label="{{ $value }} out of 5 stars">{{ str_repeat('★', $value) }}{{ str_repeat('☆', 5 - $value) }}</span>
@endif

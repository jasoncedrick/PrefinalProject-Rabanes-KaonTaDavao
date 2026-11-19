<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Eatery;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Eatery $eatery)
    {
        $eatery->reviews()->create($request->validated());

        return to_route('eateries.show', $eatery)->with('status', 'Salamat! Review posted.');
    }

    public function destroy(Review $review)
    {
        $eatery = $review->eatery;
        $review->delete();

        return to_route('eateries.show', $eatery)->with('status', 'Review deleted.');
    }
}

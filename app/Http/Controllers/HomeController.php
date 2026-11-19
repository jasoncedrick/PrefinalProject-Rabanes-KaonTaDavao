<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Review;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'eateryCount' => Eatery::count(),
            'districtCount' => District::count(),
            'reviewCount' => Review::count(),
            'topRated' => Eatery::forCards()->has('reviews')
                ->orderByDesc('reviews_avg_rating')->orderBy('name')->limit(3)->get(),
        ]);
    }
}

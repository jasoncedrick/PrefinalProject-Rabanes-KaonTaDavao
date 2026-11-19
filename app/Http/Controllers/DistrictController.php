<?php

namespace App\Http\Controllers;

use App\Models\District;

class DistrictController extends Controller
{
    public function index()
    {
        return view('districts.index', [
            'districts' => District::withCount('eateries')->orderBy('name')->get(),
        ]);
    }

    public function show(District $district)
    {
        $district->loadCount('reviews');
        $eateries = $district->eateries()->forCards()->orderBy('name')->get();

        return view('districts.show', compact('district', 'eateries'));
    }
}

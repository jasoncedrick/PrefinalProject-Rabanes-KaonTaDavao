<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class EateryController extends Controller
{
    public function index(Request $request)
    {
        $query = Eatery::forCards();
        if ($request->filled('q')) {
            $term = '%'.$request->query('q').'%';
            $query->where(function ($query) use ($term) {
                $query->where('name', 'like', $term)->orWhere('specialty', 'like', $term);
            });
        }
        if ($request->filled('district')) {
            $query->where('district_id', $request->query('district'));
        }
        if ($request->filled('feature')) {
            $query->whereHas('features', fn ($features) => $features->where('name', $request->query('feature')));
        }

        $eateries = $query->orderBy('name')->paginate(6)->withQueryString();
        return view('eateries.index', ['eateries' => $eateries] + $this->formOptions());
    }

    public function create()
    {
        return view('eateries.create', ['eatery' => new Eatery(['is_open' => true])] + $this->formOptions());
    }

    public function store(StoreEateryRequest $request)
    {
        $eatery = new Eatery();
        $this->saveEatery($eatery, $request->validated());

        return to_route('eateries.show', $eatery)->with('status', 'Eatery added.');
    }

    public function show(Eatery $eatery)
    {
        $eatery->load(['district', 'features', 'permit', 'dishes',
            'reviews' => fn ($reviews) => $reviews->with('user')->latest()->orderByDesc('id'),
        ]);
        $users = $eatery->is_open ? User::orderBy('name')->get() : collect();

        return view('eateries.show', compact('eatery', 'users'));
    }

    public function edit(Eatery $eatery)
    {
        $eatery->load(['features', 'permit']);
        return view('eateries.edit', ['eatery' => $eatery] + $this->formOptions());
    }

    public function update(UpdateEateryRequest $request, Eatery $eatery)
    {
        $this->saveEatery($eatery, $request->validated());

        return to_route('eateries.show', $eatery)->with('status', 'Eatery updated.');
    }

    public function destroy(Eatery $eatery)
    {
        DB::transaction(function () use ($eatery) {
            $eatery->features()->detach();
            $eatery->reviews()->delete();
            $eatery->dishes()->delete();
            $eatery->permit()->delete();
            $eatery->delete();
        });

        return to_route('eateries.index')->with('status', 'Eatery deleted.');
    }

    private function formOptions(): array
    {
        return [
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
        ];
    }

    private function saveEatery(Eatery $eatery, array $data): void
    {
        DB::transaction(function () use ($eatery, $data) {
            $slug = Str::slug($data['name']);
            $matches = Eatery::where('slug', $slug);
            if ($eatery->exists) {
                $matches->where('id', '!=', $eatery->id);
            }
            if ($slug === '' || $slug === 'create' || $matches->exists()) {
                throw ValidationException::withMessages(['name' => 'Choose a name with a distinct web address.']);
            }

            $eatery->fill(Arr::only($data, ['name', 'district_id', 'address', 'price_range', 'specialty']));
            $eatery->is_open = $data['is_open'] ?? false;
            $eatery->slug = $slug;
            $eatery->save();
            $eatery->permit()->updateOrCreate([], Arr::only($data, ['permit_no', 'expires_on']));
            $eatery->features()->sync($data['features']);
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EaterySeeder extends Seeder
{
    public function run(): void
    {
        $name = 'Carinderia ni Rabanes';
        $eatery = Eatery::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'district_id' => District::where('name', 'Poblacion')->firstOrFail()->id,
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        $eatery->features()->sync(Feature::whereIn('name', ['Suki ni Rabanes', 'Budget Meal'])->pluck('id'));
        $expiry = new \DateTimeImmutable(config('guide.permit_expiry'));
        $eatery->permit()->create([
            'permit_no' => 'DVO-2026-'.$expiry->format('md'),
            'expires_on' => $expiry->format('Y-m-d'),
        ]);
        $eatery->dishes()->createMany([
            ['name' => 'Tinolang Manok', 'price' => 85, 'is_bestseller' => true],
            ['name' => 'Kinilaw na Tuna', 'price' => 120],
            ['name' => 'Durian Shake', 'price' => 75],
        ]);

        $others = Eatery::factory(11)->create()->concat(Eatery::factory(3)->closed()->create());
        $features = Feature::pluck('id');
        foreach ($others as $index => $other) {
            $permit = Permit::factory()->for($other)->create();
            if ($index === 0) {
                $permit->update(['expires_on' => today()->subDay()]);
            }
            Dish::factory(random_int(2, 5))->for($other)->create();
            $other->features()->attach($features->random(random_int(1, 3))->all());
        }
    }
}

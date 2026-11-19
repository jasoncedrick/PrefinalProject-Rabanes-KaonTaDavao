<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EateryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Kusina ni Bebang', 'Talomo Ihawan', 'Bahay Sabaw', 'Pares sa Kanto',
            'Agdao Grill', 'Saging at Gata', 'Toril Tapsihan', 'Lola Belen’s Kitchen',
            'Kusina sa Likod', 'Tuna Tambayan', 'Kanto Silog', 'Balay Tinola',
            'Sariwa Seafood', 'Manokan ni Jun',
        ]);

        return [
            'district_id' => District::inRandomOrder()->firstOrFail()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => fake()->buildingNumber().' Rizal St., Davao City',
            'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
            'specialty' => fake()->randomElement(['Chicken Inasal', 'Pork Adobo', 'Beef Pares']),
            'is_open' => true,
        ];
    }

    public function closed(): static
    {
        return $this->state(['is_open' => false]);
    }
}

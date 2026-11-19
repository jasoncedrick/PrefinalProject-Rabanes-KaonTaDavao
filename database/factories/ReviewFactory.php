<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->firstOrFail()->id,
            'rating' => fake()->numberBetween(1, 5),
            'body' => fake()->randomElement([
                'The serving was generous and the food arrived hot.',
                'Ganahan ko sa sabaw. Mubalik ko diri puhon.',
                'We stopped here for lunch after class.',
            ]),
        ];
    }
}

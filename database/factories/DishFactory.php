<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Bistek', 'Pancit', 'Bulalo', 'Sisig', 'Laing', 'Chopsuey']),
            'price' => fake()->numberBetween(45, 160),
            'is_bestseller' => fake()->boolean(25),
        ];
    }
}

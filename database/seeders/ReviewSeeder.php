<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $eatery = Eatery::where('slug', 'carinderia-ni-rabanes')->firstOrFail();
        $eatery->reviews()->create([
            'user_id' => User::where('email', 'tita.rabanes@kaonta.test')->firstOrFail()->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Rabanes.',
        ]);
        Review::factory(2)->for($eatery)->create();

        $others = Eatery::where('is_open', true)->where('id', '!=', $eatery->id)->get();
        foreach ($others as $other) {
            Review::factory(random_int(0, 6))->for($other)->create();
        }
    }
}

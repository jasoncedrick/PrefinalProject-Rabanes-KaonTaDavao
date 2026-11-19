<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Jason Cedrick Rabanes' => 'rabanes', 'Tita Rabanes' => 'tita.rabanes'] as $name => $email) {
            User::create([
                'name' => $name,
                'email' => $email.'@kaonta.test',
                'password' => Hash::make(config('guide.demo_password') ?: Str::random(32)),
            ]);
        }

        User::factory(10)->create();
    }
}

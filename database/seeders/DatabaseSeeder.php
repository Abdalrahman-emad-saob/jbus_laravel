<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\PassengerProfile;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => User::$superAdmin
        ]);
        \App\Models\User::factory()->create([
            'name' => 'abood1139',
            'email' => 'aboodsaob1139@gmail.com',
            'role' => User::$passenger
        ]);
        // \App\Models\PassengerProfile::factory()->create([
        //     'passenger_id' => 11,
        // ]);
        \App\Models\OTP::factory(10)->create();
        \App\Models\PassengerProfile::factory(10)->create();
        \App\Models\Point::factory(10)->create();
        \App\Models\Route::factory(10)->create();
        \App\Models\University::factory(10)->create();
        \App\Models\PaymentTransaction::factory(10)->create();
        \App\Models\FavoritePoint::factory(10)->create();
        \App\Models\UniversityRoute::factory(10)->create();
        \App\Models\Bus::factory(10)->create();
        \App\Models\Trip::factory(10)->create();

    }
}

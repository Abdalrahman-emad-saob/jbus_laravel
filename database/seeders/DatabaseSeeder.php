<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\OTP::factory(10)->create();
        \App\Models\PassengerProfile::factory(10)->create();
        \App\Models\Point::factory(10)->create();
        \App\Models\InterestPoint::factory(10)->create();
        \App\Models\Route::factory(10)->create();
        \App\Models\FavoritePoint::factory(10)->create();
        \App\Models\Bus::factory(10)->create();
        \App\Models\Trip::factory(10)->create();
        \App\Models\PaymentTransaction::factory(10)->create();
        \App\Models\ChargingTransaction::factory(10)->create();



        \App\Models\User::factory()->create([
            'name' => 'Abood Saob',
            'email' => 'aboodsaob1139@gmail.com',
            'role' => User::$passenger
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Fadl Masri',
            'email' => 'fdlmasri@gmail.com',
            'role' => User::$passenger
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Asem Qarawy',
            'email' => 'asemqarawy@gmail.com',
            'role' => User::$admin,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Ahmad King',
            'email' => 'AEMKing@gmail.com',
            'role' => User::$superAdmin,
        ]);
        \App\Models\PassengerProfile::factory()->create([
            'passenger_id' => 11,
        ]);
        \App\Models\PassengerProfile::factory()->create([
            'passenger_id' => 12,
            'wallet' => 300,
        ]);
        \App\Models\PassengerProfile::factory()->create([
            'passenger_id' => 13,
        ]);
        \App\Models\PassengerProfile::factory()->create([
            'passenger_id' => 14,
        ]);
        \App\Models\Point::factory()->create([
            'name' => 'JUST Bus Station',
            'latitude' => 32.49512209286742,
            'longitude' => 35.98597417188871,
        ]);
        \App\Models\Point::factory()->create([
            'name' => 'North Bus Station',
            'latitude' => 31.9957018434082,
            'longitude' => 35.91987132195803,
        ]);
        \App\Models\Point::factory()->create([
            'name' => 'حي الجامعة الاردنية',
            'latitude' => 32.02511248566629,
            'longitude' => 35.89201395463377,
        ]);
        \App\Models\InterestPoint::factory()->create([
            'name' => 'North Bus Station',
            'logo' => 'storage/5.png',
            'location' => 11,
        ]);
        \App\Models\InterestPoint::factory()->create([
            'name' => 'JUST Bus Station',
            'logo' => 'storage/5.png',
            'location' => 12,
        ]);
        \App\Models\Route::factory()->create([
            'name' => 'Amman-JUST',
            'starting_point' => 11,
            'ending_point' => 12,
            'waypoints_going' => json_encode([
                [
                    "Location" => [
                        "Latitude" => 31.9957018434082,
                        "Longitude" => 35.91987132195803,
                    ],
                ],
                [
                    "Location" => [
                        "Latitude" => 32.21854548546048,
                        "Longitude" => 35.89057887311955,
                    ],
                ],
                [
                    "Location" => [
                        "Latitude" => 32.49512209286742,
                        "Longitude" => 35.98597417188871,
                    ],
                ],
            ]),
            'waypoints_returning' => json_encode([
                [
                    "Location" => [
                        "Latitude" => 32.49512209286742,
                        "Longitude" => 35.98597417188871,
                    ],
                ],
                [
                    "Location" => [
                        "Latitude" => 32.21854548546048,
                        "Longitude" => 35.89057887311955,
                    ],
                ],
                [
                    "Location" => [
                        "Latitude" => 31.9957018434082,
                        "Longitude" => 35.91987132195803,
                    ],

                ],
            ]),
            'fee' => 115,
        ]);
        \App\Models\FavoritePoint::factory()->create([
            'passenger_id' => 12,
            'route_id' => 11,
            'point_id' => 13,
        ]);
        \App\Models\Bus::factory()->create([
            // 'number' => 5012345,
            // 'capacity' => 44,
            // 'route_id' =>  11,
            // 'driver_id' => 1, //i dont think this is needed maybe there are no drivers
            'number' => 5012345,
            'capacity' => 44,
            'route_id' =>  11,
            // 'driver_id' => User::where('role', User::$driver)->inRandomOrder()->first()->id,
        ]);
        \App\Models\ChargingTransaction::factory()->create([
            'passenger_id' => 12,
            'amount' => 300,
        ]);
        \App\Models\Trip::factory()->create([
            'rating' => 5,
            'finished_at' => now(),
            'status' => 'COMPLETED',
            'passenger_id' => 12,
            'route_id' => 11,
            'pickup_point_id' => 13,
            'dropoff_point_id' => 12,
            'bus_id' => 11
        ]);
        \App\Models\Trip::factory()->create([
            'rating' => 5,
            'finished_at' => now(),
            'status' => 'PENDING',
            'passenger_id' => 11,
            'route_id' => 11,
            'pickup_point_id' => 11,
            'dropoff_point_id' => 12,
            'bus_id' => 10
        ]);
        \App\Models\PaymentTransaction::factory()->create([
            'passenger_id' => 12,
            'amount' => 115,
        ]);
    }
}

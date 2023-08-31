<?php

namespace Database\Factories;

use App\Models\Point;
use App\Models\Route;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rating' => rand(1, 5),
            'finished_at' => now(),
            'status' => Arr::random([Trip::$canceled, Trip::$completed, Trip::$pending, Trip::$onGoing]),
            'passenger_id' => User::where('role', User::$passenger)->inRandomOrder()->first()->id,
            'route_id' => Route::all()->random()->id,
            'pickup_point_id' => Point::all()->random()->id,
            'dropoff_point_id' => Point::all()->random()->id,
        ];
    }
}

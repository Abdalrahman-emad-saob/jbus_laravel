<?php

namespace Database\Factories;

use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => Str::random(8),
            'capacity' => rand(0, 50),
            'route_id' =>  Route::all()->random()->id,
            'driver_id' => User::where('role', User::$driver)->inRandomOrder()->first()->id,
        ];
    }
}

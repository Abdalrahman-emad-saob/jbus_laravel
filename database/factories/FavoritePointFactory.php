<?php

namespace Database\Factories;

use App\Models\Point;
use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FavoritePoint>
 */
class FavoritePointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'passenger_id' => User::where('role', User::$passenger)->inRandomOrder()->first()->id,
            'route_id' => Route::all()->random()->id,
            'point_id' => Point::all()->random()->id
        ];
    }
}

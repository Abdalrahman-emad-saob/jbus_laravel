<?php

namespace Database\Factories;

use App\Models\Route;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UniversityRoute>
 */
class UniversityRouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'university_id' => University::all()->random()->id,
            'route_id' => Route::all()->random()->id,

        ];
    }
}

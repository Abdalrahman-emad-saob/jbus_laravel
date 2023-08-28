<?php

namespace Database\Factories;

use App\Models\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InterestPoint>
 */
class InterestPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'logo' => 'storage/5.png',
            'location' => Point::all()->random()->id,
        ];
    }
}

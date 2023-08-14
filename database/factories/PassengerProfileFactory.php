<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PassengerProfile>
 */
class PassengerProfileFactory extends Factory
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
            'picture' => 'storage/5.png',
            'wallet' => rand(0, 50)
        ];
    }
}

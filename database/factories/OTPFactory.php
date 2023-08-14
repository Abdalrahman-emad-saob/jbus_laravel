<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OTP>
 */
class OTPFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => str_pad(rand(0, pow(10, 4)-1),4, '0', STR_PAD_LEFT),
            'passenger_id' => User::where('role', User::$passenger)->inRandomOrder()->first()->id,
            'email' => User::where('role', User::$passenger)->inRandomOrder()->first()->email
        ];
    }
}

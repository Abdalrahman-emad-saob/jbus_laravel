<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChargingTransaction>
 */
class ChargingTransactionFactory extends Factory
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
            'amount' => rand(0, 50),
            // 'payment_method_id' => Stripe::all()->random()->id // STRIPE DO NOT FORGET
        ];
    }
}

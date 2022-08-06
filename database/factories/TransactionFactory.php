<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status' => rand(0, 2),
            'user_id' => rand(1, 10),
            'username' => $this->faker->username,
            'user_phone' => $this->faker->phoneNumber,
            'amount' => rand(1000000, 100000000),
            'payment' => $this->faker->text,
            'payment_info' => $this->faker->text,
            'message' => $this->faker->text,
            'security_code' => $this->faker->randomLetter(),
        ];
    }
}

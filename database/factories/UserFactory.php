<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => Hash::make(123456),
            'avatar' => $this->faker->imageUrl(100, 100),
            'role' => rand(0, 1),
            'status' => rand(0, 1),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'amount_cart' => 0,
        ];
    }
}

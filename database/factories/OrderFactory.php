<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'transaction_id' => rand(1, 10),
            'product_id' => rand(1, 10),
            'qty' => 3,
            'amount' => rand(1000000, 10000000),

            'status' => rand(0, 1)
        ];
    }
}

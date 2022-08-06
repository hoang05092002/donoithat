<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => Str::random(6),
            'catalog_id' => rand(1, 10),
            'name' => $this->faker->name,
            'main_img' => $this->faker->imageUrl(100, 100),
            'brand' => Str::random(6),
            'description' => $this->faker->text(),
            'size' => rand(0, 2),
            'price' => rand(100000, 10000000),
            'discount' => rand(0, 20),
            'status' => rand(0, 1),
            'view' => rand(0, 200),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\V1\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cartCustomerId' => fake()->city(),
            'cartProductId' => fake()->name(),
            'cartProductName' => fake()->randomNumber(),
            'cartProductQuantity' => fake()->sentence(),
        ];
    }
}




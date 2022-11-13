<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\V1\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

            return [
                'deliveryState' => fake()->city(),
                'deliveryStatus' => fake()->name(),
                'deliveryFee' => fake()->randomNumber(),
                'deliveryDescription' => fake()->sentence(),
            ];

    }
}

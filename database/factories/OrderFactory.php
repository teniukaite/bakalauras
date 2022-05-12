<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->numberBetween(1, 3),
            'client_id' => $this->faker->numberBetween(1, 100),
            'order_date' => $this->faker->dateTimeBetween('-1 years'),
            'freelancer_id' => $this->faker->numberBetween(1, 100),
            'service_id' => $this->faker->numberBetween(1, 49),
        ];
    }
}

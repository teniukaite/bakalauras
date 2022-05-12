<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'askedBy_id' => $this->faker->numberBetween(1, 100),
            'answeredBy_id' => $this->faker->numberBetween(1, 100),
            'question' => $this->faker->sentence(),
            'answer' => $this->faker->sentence(),
            'state' => $this->faker->numberBetween(0, 2),
        ];
    }
}

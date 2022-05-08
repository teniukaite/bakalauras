<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    public function definition(): array
    {
        return [
            'service_name' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'city' => $this->faker->numberBetween(1, 57),
            'freelancer_id' => $this->faker->numberBetween(1, 100),
            'category_id' => $this->faker->numberBetween(1, 100),
            'duration' => $this->faker->numberBetween(1, 100),
            'price_content' => 'eur/val',
        ];
    }
}

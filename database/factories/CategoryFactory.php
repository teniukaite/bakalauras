<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = [
            'Mechanika',
            'Elektronika',
            'Informatika',
            'Grožis',
            'Pagalbiniai darbai',
            'Švietimas',
        ];
        return [
            'name' => $this->faker->randomElement($categories),

            //'parent_id' => $this->faker->boolean(50) ? Category::orderByRaw('RAND()')->first()->id : null
        ];
    }
}

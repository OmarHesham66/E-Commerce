<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $counter = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $titleCategory = ['Summer T-Shirt', 'Winter T-Shirt', 'Qamis'];

        return [
            'name' => fake()->name(),
            'title-category' => fake()->randomElement($titleCategory),
            'description' => fake()->text(100),
            'photo' => 'Product-' . $this->counter++ . '.jpg',
            'price' => fake()->numberBetween(100, 500),
            'avaliable' => 'Avaliable',
            'quantity' => fake()->numberBetween(5, 8),
            'category_id' => 2,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $titleCategory = ['Summer T-Shirt', 'Winter T-Shirt', 'Qamis'];
        $name = $faker->productName;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'title-category' => fake()->randomElement($titleCategory),
            'description' => fake()->text(100),
            'photo' => fake()->imageUrl(650, 650),
            'price' => fake()->numberBetween(100, 500),
            'avaliable' => 'Avaliable',
            'quantity' => fake()->numberBetween(5, 8),
            'category_id' => 25,
        ];
    }
}

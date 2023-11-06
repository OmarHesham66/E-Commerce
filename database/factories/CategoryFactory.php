<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $counter1 = 0;
    protected $counter2 = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $arr = ['Shirts', 'Jackets', 'Caps', 'Shoes', 'Shorts', 'Hoodies'];
        $arr = ['Dresses', 'Blouses', 'Hoodies', 'WomenSets', 'Leggings', 'Skirts', 'Jeans'];
        // $arr = ['Laptops', 'Accessories-Laptops', 'Phones', 'Accessories-Phones'];
        // $arr2=['']
        return [
            'name' => $arr[$this->counter1++],
            'photo' => fake()->imageUrl(650, 650, $arr[$this->counter1], true, $arr[$this->counter1], false, 'png'),
            'main_category_id' => 3
        ];
    }
}

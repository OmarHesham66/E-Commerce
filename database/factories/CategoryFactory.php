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
        $arr = ['Shirts', 'Jackets', 'Caps', 'Shoes', 'Shorts', 'Hoodies'];
        // $arr = ['Dresses', 'Blouses', 'Shirts', 'Hoodies', 'WomenSets', 'Leggings', 'Skirts', 'Shorts', 'Jeans'];
        // $arr = ['Laptops', 'LaptopAccessories', 'Phones', 'PhoneAccessories'];
        // $arr2=['']
        return [
            'name' => $arr[$this->counter1++],
            'photo' =>  $arr[$this->counter2++] . '.jpg',
            'super_categories_id' => 2
        ];
    }
}

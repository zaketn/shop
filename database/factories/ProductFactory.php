<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * @extends Factory<Product>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->words(2, true)),
            'price' => fake()->numberBetween(10000, 100000),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'thumbnail' => $this->faker->fixtures(
                'products',
                'images/products'
            )
        ];
    }
}

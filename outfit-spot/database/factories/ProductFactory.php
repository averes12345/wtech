<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        $features = [
            'slim fit', 'relaxed fit', 'button-down', 'V-neck',
            'crew neck', 'zip-up', 'drawstring waist', 'elastic cuffs',
            'breathable fabric', 'water-resistant', 'distressed finish',
            'acid wash effect', 'rolled cuffs', 'chunky knit',
            'embroidered detailing', 'peplum waist', 'asymmetric hem',
            'pleated design', 'layered ruffles', 'oversized silhouette'
        ];

        $featureSnippet = implode(' ', $this->faker->randomElements(
            $features,
            random_int(2, 5)
        ));


        return [
            'name' => $this->faker->unique()->words(2, true),
            'description'  => ucfirst($featureSnippet) . '.',
            'price' => $this->faker->randomFloat(2, 5, 380),
            'type' => $this->faker->randomElement(['male', 'female', 'kids']),
//            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

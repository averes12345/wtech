<?php

namespace Database\Seeders;

use App\Models\ProductColorSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dir = '../img/';

        $shirtsDir = '../img/shirts/';
        $hoodiesDir = '../img/hoodies/';
        $pantsDir = '../img/pants/';
        $shoesDir = '../img/shoes/';

        $shirtsImages = [
            ['path' => $shirtsDir . 'gpt-shirt-green.png',  'color_id' => 2],
            ['path' => $shirtsDir . 'gpt-shirt-green-2.png',  'color_id' => 2],
            ['path' => $shirtsDir . 'gpt-shirt-red.png',  'color_id' => 1],
            ['path' => $shirtsDir . 'gpt-shirt-red-2.png',  'color_id' => 1],
            ['path' => $shirtsDir . 'gpt-shirt-white.png', 'color_id' => 6],
            ['path' => $shirtsDir . 'gpt-shirt-white-2.png', 'color_id' => 6],
            ['path' => $shirtsDir . 'gpt-shirt-orange.png', 'color_id' => 7],
            ['path' => $shirtsDir . 'gpt-shirt-orange-2.png', 'color_id' => 7],
            ['path' => $shirtsDir . 'gpt-shirt-blue.png',  'color_id' => 3],
            ['path' => $shirtsDir . 'gpt-shirt-blue-2.png',  'color_id' => 3],
            ['path' => $shirtsDir . 'gpt-shirt-yellow.png', 'color_id' => 4],
            ['path' => $shirtsDir . 'gpt-shirt-yellow-2.png', 'color_id' => 4],
            ['path' => $shirtsDir . 'gpt-shirt-black.png',  'color_id' => 5],
            ['path' => $shirtsDir . 'gpt-shirt-black-2.png',  'color_id' => 5],
            ['path' => $shirtsDir . 'gpt-shirt-purple.png', 'color_id' => 8],
            ['path' => $shirtsDir . 'gpt-shirt-purple-2.png', 'color_id' => 8],
            ['path' => $shirtsDir . 'gpt-shirt-brown.png',  'color_id' => 9],
            ['path' => $shirtsDir . 'gpt-shirt-brown-2.png',  'color_id' => 9],
        ];
        $pantsImages = [
            ['path' => $dir . 'gpt-shirt-green.png',  'color_id' => 2],
            ['path' => $dir . 'gpt-shirt-green-2.png',  'color_id' => 2],
            ['path' => $dir . 'gpt-shirt-red.png',  'color_id' => 1],
            ['path' => $dir . 'gpt-shirt-red-2.png',  'color_id' => 1],
            ['path' => $dir . 'gpt-shirt-white.png', 'color_id' => 6],
            ['path' => $dir . 'gpt-shirt-white-2.png', 'color_id' => 6],
            ['path' => $dir . 'gpt-shirt-orange.png', 'color_id' => 7],
            ['path' => $dir . 'gpt-shirt-orange-2.png', 'color_id' => 7],
            ['path' => $dir . 'gpt-shirt-blue.png',  'color_id' => 3],
            ['path' => $dir . 'gpt-shirt-blue-2.png',  'color_id' => 3],
            ['path' => $dir . 'gpt-shirt-yellow.png', 'color_id' => 4],
            ['path' => $dir . 'gpt-shirt-yellow-2.png', 'color_id' => 4],
            ['path' => $dir . 'gpt-shirt-black.png',  'color_id' => 5],
            ['path' => $dir . 'gpt-shirt-black-2.png',  'color_id' => 5],
            ['path' => $dir . 'gpt-shirt-purple.png', 'color_id' => 8],
            ['path' => $dir . 'gpt-shirt-purple-2.png', 'color_id' => 8],
            ['path' => $dir . 'gpt-shirt-brown.png',  'color_id' => 9],
            ['path' => $dir . 'gpt-shirt-brown-2.png',  'color_id' => 9],
        ];
        $hoodiesImages = [
            ['path' => $hoodiesDir . 'gpt-hoodie-green.png',  'color_id' => 2],
            ['path' => $hoodiesDir . 'gpt-hoodie-green-2.png',  'color_id' => 2],
            ['path' => $hoodiesDir . 'gpt-hoodie-red.png',  'color_id' => 1],
            ['path' => $hoodiesDir . 'gpt-hoodie-red-2.png',  'color_id' => 1],
            ['path' => $hoodiesDir . 'gpt-hoodie-white.png', 'color_id' => 6],
            ['path' => $hoodiesDir . 'gpt-hoodie-white-2.png', 'color_id' => 6],
            ['path' => $hoodiesDir . 'gpt-hoodie-orange.png', 'color_id' => 7],
            ['path' => $hoodiesDir . 'gpt-hoodie-orange-2.png', 'color_id' => 7],
            ['path' => $hoodiesDir . 'gpt-hoodie-blue.png',  'color_id' => 3],
            ['path' => $hoodiesDir . 'gpt-hoodie-blue-2.png',  'color_id' => 3],
            ['path' => $hoodiesDir . 'gpt-hoodie-yellow.png', 'color_id' => 4],
            ['path' => $hoodiesDir . 'gpt-hoodie-yellow-2.png', 'color_id' => 4],
            ['path' => $hoodiesDir . 'gpt-hoodie-black.png',  'color_id' => 5],
            ['path' => $hoodiesDir . 'gpt-hoodie-black-2.png',  'color_id' => 5],
            ['path' => $hoodiesDir . 'gpt-hoodie-purple.png', 'color_id' => 8],
            ['path' => $hoodiesDir . 'gpt-hoodie-purple-2.png', 'color_id' => 8],
            ['path' => $hoodiesDir . 'gpt-hoodie-brown.png',  'color_id' => 9],
            ['path' => $hoodiesDir . 'gpt-hoodie-brown-2.png',  'color_id' => 9],
        ];
        $shoesImages = [
            ['path' => $dir . 'gpt-shirt-green.png',  'color_id' => 2],
            ['path' => $dir . 'gpt-shirt-green-2.png',  'color_id' => 2],
            ['path' => $dir . 'gpt-shirt-red.png',  'color_id' => 1],
            ['path' => $dir . 'gpt-shirt-red-2.png',  'color_id' => 1],
            ['path' => $dir . 'gpt-shirt-white.png', 'color_id' => 6],
            ['path' => $dir . 'gpt-shirt-white-2.png', 'color_id' => 6],
            ['path' => $dir . 'gpt-shirt-orange.png', 'color_id' => 7],
            ['path' => $dir . 'gpt-shirt-orange-2.png', 'color_id' => 7],
            ['path' => $dir . 'gpt-shirt-blue.png',  'color_id' => 3],
            ['path' => $dir . 'gpt-shirt-blue-2.png',  'color_id' => 3],
            ['path' => $dir . 'gpt-shirt-yellow.png', 'color_id' => 4],
            ['path' => $dir . 'gpt-shirt-yellow-2.png', 'color_id' => 4],
            ['path' => $dir . 'gpt-shirt-black.png',  'color_id' => 5],
            ['path' => $dir . 'gpt-shirt-black-2.png',  'color_id' => 5],
            ['path' => $dir . 'gpt-shirt-purple.png', 'color_id' => 8],
            ['path' => $dir . 'gpt-shirt-purple-2.png', 'color_id' => 8],
            ['path' => $dir . 'gpt-shirt-brown.png',  'color_id' => 9],
            ['path' => $dir . 'gpt-shirt-brown-2.png',  'color_id' => 9],
        ];

        $product_variants = ProductColorSize::with('product')->get();

        foreach ($product_variants as $variant) {

            switch ($variant->product->category_id) {
                case 1:
                    $pool = $shirtsImages;
                    break;
                case 2:
                    $pool = $hoodiesImages;
                    break;
                case 3:
                    $pool = $pantsImages;
                    break;
                case 4:
                    $pool = $shoesImages;
                    break;
            }

            $candidates = array_values(
                array_filter($pool, fn($img) => $img['color_id'] === $variant->colors_id)
            );

            if (empty($candidates)) {
                $candidates = $pool;
            }

            foreach ($candidates as $index => $img) {
                ProductImage::create([
                    'product_color_sizes_id' => $variant->id,
                    'image_path'             => $img['path'],
                    'alt'                    => 'Product Image',
                    'is_main'                => $index === 0,
                ]);
            }
        }
    }
}

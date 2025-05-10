<?php

namespace Database\Seeders;

use App\Models\ProductColorSize;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $shirtsDir = '/img/shirts/';
        $hoodiesDir = '/img/hoodies/';
        $pantsDir = '/img/pants/';
        $shoesDir = '/img/shoes/';

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
            ['path' => $pantsDir . 'gpt-pants-green.png',  'color_id' => 2],
            ['path' => $pantsDir . 'gpt-pants-red.png',  'color_id' => 1],
            ['path' => $pantsDir . 'gpt-pants-white.png', 'color_id' => 6],
            ['path' => $pantsDir . 'gpt-pants-orange.png', 'color_id' => 7],
            ['path' => $pantsDir . 'gpt-pants-blue.png',  'color_id' => 3],
            ['path' => $pantsDir . 'gpt-pants-yellow.png', 'color_id' => 4],
            ['path' => $pantsDir . 'gpt-pants-black.png',  'color_id' => 5],
            ['path' => $pantsDir . 'gpt-pants-purple.png', 'color_id' => 8],
            ['path' => $pantsDir . 'gpt-pants-brown.png',  'color_id' => 9],
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
            ['path' => $shoesDir . 'gpt-shoe-green.png',  'color_id' => 2],
            ['path' => $shoesDir . 'gpt-shoe-red.png',  'color_id' => 1],
            ['path' => $shoesDir . 'gpt-shoe-white.png', 'color_id' => 6],
            ['path' => $shoesDir . 'gpt-shoe-orange.png', 'color_id' => 7],
            ['path' => $shoesDir . 'gpt-shoe-orange-2.png', 'color_id' => 7],
            ['path' => $shoesDir . 'gpt-shoe-blue.png',  'color_id' => 3],
            ['path' => $shoesDir . 'gpt-shoe-yellow.png', 'color_id' => 4],
            ['path' => $shoesDir . 'gpt-shoe-black.png',  'color_id' => 5],
            ['path' => $shoesDir . 'gpt-shoe-purple.png', 'color_id' => 8],
            ['path' => $shoesDir . 'gpt-shoe-brown.png',  'color_id' => 9],
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

                //1. Vytáranie kopii obrázkov pre každú variantu
//                $originalPath = public_path($img['path']);
//
//                $pathInfo = pathinfo($originalPath);
//                $newFilename = $pathInfo['filename'] . '_' . $variant->id;
//                $newPathDB = "../img/copies" . '/' . $newFilename;
//                $newPath = public_path('img/copies/' . $newFilename);
//
//                if (!File::exists($newPath)) {
//                    File::copy($originalPath, $newPath);
//                }
//
//
//                ProductImage::create([
//                    'product_color_sizes_id' => $variant->id,
//                    'image_path'             => $newPathDB,
//                    'alt'                    => 'Product Image',
//                    'is_main'                => $index === 0,
//                ]);


                //1. Obrázky sa zdielaju pre všetky varianty
//                ProductImage::create([
//                    'product_color_sizes_id' => $variant->id,
//                    'image_path'             => $img['path'],
//                    'alt'                    => 'Product Image',
//                    'is_main'                => $index === 0,
//                ]);
            }
        }
    }
}

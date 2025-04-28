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
//        ProductImage::create([
//            'product_color_sizes_id' => '1',
//            'image_path' =>  'img/gpt-nike-shoe.png',
//            'alt' => 'An image of an orange nike running shoe.',
//        ]);
//
//        ProductImage::create([
//            'product_color_sizes_id' => '2',
//            'image_path' =>  'img/gpt-shirt-green.png',
//            'alt' => 'An image of a green short-sleeved t-shirt.',
//        ]);
//        ProductImage::create([
//            'product_color_sizes_id' => '3',
//            'image_path' =>  'img/gpt-shirt-red.png',
//            'alt' => 'An image of a red short-sleeved t-shirt.',
//        ]);
//        ProductImage::create([
//            'product_color_sizes_id' => '4',
//            'image_path' =>  'img/gpt-shirt-white.png',
//            'alt' => 'An image of a white short-sleeved t-shirt.',
//        ]);
//        ProductImage::create([
//            'product_color_sizes_id' => '5',
//            'image_path' =>  'img/gpt-shirt-orange.png',
//            'alt' => 'An image of an orange short-sleeved t-shirt.',
//        ]);
//
//        ProductImage::create([
//            'product_color_sizes_id' => '6',
//            'image_path' =>  'img/gpt-shoe-blue.png',
//            'alt' => 'An image of a blue running shoe.',
//        ]);
//        ProductImage::create([
//            'product_color_sizes_id' => '7',
//            'image_path' =>  'img/gpt-shoe-green.png',
//            'alt' => 'An image of a green running shoe.',
//        ]);
//
//        ProductImage::create([
//            'product_color_sizes_id' => '8',
//            'image_path' =>  'img/gpt-shoe-red.png',
//            'alt' => 'An image of a red running shoe.',
//        ]);
//         ProductImage::create([
//            'product_color_sizes_id' => '9',
//            'image_path' =>  'img/gpt-shoe-yellow.png',
//            'alt' => 'An image of a yellow running shoe.',
//        ]);

        $dir = '../img/';
        $product_variants = ProductColorSize::all();
        $images = [
            [
                'path' => $dir . 'gpt-nike-shoe.png',
                'alt'  => 'An image of an orange nike running shoe.',
            ],
            [
                'path' => $dir . 'gpt-shirt-green.png',
                'alt'  => 'An image of a green short-sleeved t-shirt.',
            ],
            [
                'path' => $dir . 'gpt-shirt-red.png',
                'alt'  => 'An image of a red short-sleeved t-shirt.',
            ],
            [
                'path' => $dir . 'gpt-shirt-white.png',
                'alt'  => 'An image of a white short-sleeved t-shirt.',
            ],
            [
                'path' => $dir . 'gpt-shirt-orange.png',
                'alt'  => 'An image of an orange short-sleeved t-shirt.',
            ],
            [
                'path' => $dir . 'gpt-shoe-blue.png',
                'alt'  => 'An image of a blue running shoe.',
            ],
            [
                'path' => $dir . 'gpt-shoe-green.png',
                'alt'  => 'An image of a green running shoe.',
            ],
            [
                'path' => $dir . 'gpt-shoe-red.png',
                'alt'  => 'An image of a red running shoe.',
            ],
            [
                'path' => $dir . 'gpt-shoe-yellow.png',
                'alt'  => 'An image of a yellow running shoe.',
            ],
            [
                'path' => $dir . 'hoodie-blue.png',
                'alt'  => 'An image of a blue hoodie.',
            ],
            [
                'path' => $dir . 'hoodie-brown.png',
                'alt'  => 'An image of a brown hoodie.',
            ],
        ];

        foreach ($product_variants as $product_variant) {
            $img = $images[array_rand($images)];

            ProductImage::create([
                'product_color_sizes_id' => $product_variant->id,
                'image_path' => $img['path'],
                'alt' => $img['alt'],
                'is_main' => true,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

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

    $dir = public_path('img');
        ProductImage::create([
            'product_color_sizes_id' => '1',
            'image_path' =>  'img/gpt-nike-shoe.png',
            'alt' => 'An image of an orange nike running shoe.',
        ]);

        ProductImage::create([
            'product_color_sizes_id' => '2',
            'image_path' =>  'img/gpt-shirt-green.png',
            'alt' => 'An image of a green short-sleeved t-shirt.',
        ]);
        ProductImage::create([
            'product_color_sizes_id' => '3',
            'image_path' =>  'img/gpt-shirt-red.png',
            'alt' => 'An image of a red short-sleeved t-shirt.',
        ]);
        ProductImage::create([
            'product_color_sizes_id' => '4',
            'image_path' =>  'img/gpt-shirt-white.png',
            'alt' => 'An image of a white short-sleeved t-shirt.',
        ]);
        ProductImage::create([
            'product_color_sizes_id' => '5',
            'image_path' =>  'img/gpt-shirt-orange.png',
            'alt' => 'An image of an orange short-sleeved t-shirt.',
        ]);

        ProductImage::create([
            'product_color_sizes_id' => '6',
            'image_path' =>  'img/gpt-shoe-blue.png',
            'alt' => 'An image of a blue running shoe.',
        ]);
        ProductImage::create([
            'product_color_sizes_id' => '7',
            'image_path' =>  'img/gpt-shoe-green.png',
            'alt' => 'An image of a green running shoe.',
        ]);

        ProductImage::create([
            'product_color_sizes_id' => '8',
            'image_path' =>  'img/gpt-shoe-red.png',
            'alt' => 'An image of a red running shoe.',
        ]);
         ProductImage::create([
            'product_color_sizes_id' => '9',
            'image_path' =>  'img/gpt-shoe-yellow.png',
            'alt' => 'An image of a yellow running shoe.',
        ]);



    }
}

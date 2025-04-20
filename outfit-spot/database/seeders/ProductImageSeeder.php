<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductColorSize;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            [
                'image_path' => 'public/img/Mikina1.png',
                'alt'        => 'Modrá mikina',
            ],
            [
                'image_path' => 'public/img/Mikina2.png',
                'alt'        => 'Hnedá mikina',
            ],
        ];

        $variants = ProductColorSize::all();

        foreach ($variants as $variant) {
            foreach ($images as $image) {
                ProductImage::updateOrCreate(
                    [
                        'product_color_size_id' => $variant->id,
                        'image_path'            => $image['image_path'],
                    ],
                    [
                        'alt' => $image['alt'],
                    ]
                );
            }
        }
    }
}

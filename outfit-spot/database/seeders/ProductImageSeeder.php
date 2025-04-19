<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'alt'        => 'Modra Mikina',
            ],
            [
                'image_path' => 'public/img/Mikina2.png',
                'alt'        => 'Hneda Mikina',
            ],
        ];

        foreach ($images as $image) {
            ProductImage::updateOrCreate(
                ['image_path' => $image['image_path']],
                ['alt' => $image['alt']]
            );
        }
    }
}

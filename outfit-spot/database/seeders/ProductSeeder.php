<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Product::create([
            'name'        => 'Classic Cotton T-Shirt',
            'description' => 'Soft and breathable t-shirt made of 100% cotton. Ideal for everyday wear.',
            'price'       => 19.99,
            'brand'       => 'OutfitSpot',
            'sex'         => 'unisex',
        ]);

        Product::create([
            'name'        => 'ASICS Gel-Kayano 30',
            'description' => 'High-performance running shoe designed for long-distance comfort and stability.',
            'price'       => 149.99,
            'brand'       => 'ASICS',
            'sex'         => 'female',
        ]);

        Product::create([
            'name'        => 'Nike Air Zoom Pegasus 40',
            'description' => 'Lightweight and responsive running shoe built for speed and comfort.',
            'price'       => 139.95,
            'brand'       => 'Nike',
            'sex'         => 'female',
        ]);
    }
}

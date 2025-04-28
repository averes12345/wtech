<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
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

        Product::factory(300)->create();

//    Product::create([
//            'name'        => 'Classic Cotton T-Shirt',
//            'description' => 'Soft and breathable t-shirt made of 100% cotton. Ideal for everyday wear.',
//            'price'       => 19.99,
//            'brand_id' => Brand::inRandomOrder()->first()->id,
//            'category_id' => Category::inRandomOrder()->first()->id,
//            'sex'         => 'unisex',
//        ]);
//
//        Product::create([
//            'name'        => 'ASICS Gel-Kayano 30',
//            'description' => 'High-performance running shoe designed for long-distance comfort and stability.',
//            'price'       => 149.99,
//            'brand_id' => Brand::inRandomOrder()->first()->id,
//            'category_id' => Category::inRandomOrder()->first()->id,
//            'sex'         => 'female',
//        ]);
//
//        Product::create([
//            'name'        => 'Nike Air Zoom Pegasus 40',
//            'description' => 'Lightweight and responsive running shoe built for speed and comfort.',
//            'price'       => 139.95,
//            'brand_id' => Brand::inRandomOrder()->first()->id,
//            'category_id' => Category::inRandomOrder()->first()->id,
//            'sex'         => 'female',
//        ]);
    }
}

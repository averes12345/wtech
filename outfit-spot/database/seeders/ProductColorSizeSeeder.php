<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColorSize;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductColorSizeSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $statuses = [
            'in_stock',
            'in_transit',
            'sold_out',
        ];

        foreach ($products as $product) {

            $colors = Color::inRandomOrder()->take(3)->get();

            $sizes  = Size::inRandomOrder()->take(5)->get();

            foreach ($colors as $color) {
                foreach ($sizes as $size) {
                    ProductColorSize::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'color_id'   => $color->id,
                            'size_id'    => $size->id,
                        ],
                        [
                            'count_in_stock' => rand(0, 50),
                            'status'         => $statuses[array_rand($statuses)],
                        ]
                    );
                }
            }
        }
    }
}

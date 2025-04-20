<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColorSize;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductColorSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $colors   = Color::all();
        $sizes    = Size::all();

        foreach ($products as $product) {
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
                        ]
                    );
                }
            }
        }
    }
}

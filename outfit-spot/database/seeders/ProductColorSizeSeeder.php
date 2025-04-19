<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColorSize;
use App\Models\ProductImage;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductColorSizeSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $colors   = Color::all();
        $sizes    = Size::all();

        // Načítame **všetky** obrázky bez ohľadu na product_id
        $allImages = ProductImage::all();

        foreach ($products as $product) {
            foreach ($colors as $color) {
                foreach ($sizes as $size) {
                    // Náhodne vyberieme jeden z dvoch obrázkov
                    $imageId = $allImages->random()->id;

                    ProductColorSize::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'color_id'   => $color->id,
                            'size_id'    => $size->id,
                        ],
                        [
                            'count_in_stock'   => rand(0, 50),
                            'product_image_id' => $imageId,
                        ]
                    );
                }
            }
        }
    }
}

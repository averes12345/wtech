<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductColorSize;
use App\Models\Color;

class ProductColorSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $statuses = [
            'in_stock',
            'in_transit',
            'sold_out',
        ];

        $colors = Color::all();
        $products = Product::all();
        $sizes = Size::all();

        /* For every Product create 5 variants and for every color variant create 5 size variants*/
        foreach ($products as $product) {
            $selected_colors = $colors->random(2);

            foreach ($selected_colors as $color) {
                $selected_sizes = $sizes->random(5);
                foreach ($selected_sizes as $size) {
                    ProductColorSize::create([
                        'products_id' => $product->id,
                        'colors_id' => $color->id,
                        'sizes_id' => $size->id,
                        'count_in_stock' => rand(1, 100),
                        'status' => $statuses[array_rand($statuses)],
                    ]);
                }
            }
        }

//        /* nike shoe */
//        ProductColorSize::create([
//            'products_id' => '3',
//            'colors_id' => Color::where('hex', '#ba160c')->first()?->id,
//            'sizes_id' => '1',
//            'count_in_stock' => '34',
//            'status' => $statuses[array_rand($statuses)],
//        ]);
//         /* shoe red*/
//        ProductColorSize::create([
//            'products_id' => '3',
//            'colors_id' => Color::where('hex', '#cf1020')->first()?->id,
//            'sizes_id' => '1',
//            'count_in_stock' => '34',
//            'status' => $statuses[array_rand($statuses)],
//        ]);
//         /* shoe green*/
//        ProductColorSize::create([
//            'products_id' => '3',
//            'colors_id' => Color::where('hex', '#006a4e')->first()?->id,
//            'sizes_id' => '1',
//            'count_in_stock' => '34',
//            'status' => $statuses[array_rand($statuses)],
//        ]);
//         /* shoe blue*/
//        ProductColorSize::create([
//            'products_id' => '3',
//            'colors_id' => Color::where('hex', '#004f98')->first()?->id,
//            'sizes_id' => '1',
//            'count_in_stock' => '34',
//            'status' => $statuses[array_rand($statuses)],
//        ]);
//         /* shoe yellow*/
//        ProductColorSize::create([
//            'products_id' => '3',
//            'colors_id' => Color::where('hex', '#f4c430')->first()?->id,
//            'sizes_id' => '1',
//            'count_in_stock' => '69',
//            'status' => $statuses[array_rand($statuses)],
//        ]);
//
//       /* shirt green */
//        ProductColorSize::create([
//            'products_id' => '1',
//            'colors_id' => Color::where('hex', '#355e3b')->first()?->id,
//            'sizes_id' => '2',
//            'count_in_stock' => '44',
//            'status' => $statuses[array_rand($statuses)],
//        ]);
//        /* shirt red */
//        ProductColorSize::create([
//            'products_id' => '1',
//            'colors_id' => Color::where('hex', '#701c1c')->first()?->id,
//            'sizes_id' => '2',
//            'count_in_stock' => '44',
//            'status' => $statuses[array_rand($statuses)],
//        ]);
//        /* shirt white */
//        ProductColorSize::create([
//            'products_id' => '1',
//            'colors_id' => Color::where('hex', '#e5e4e2')->first()?->id,
//            'sizes_id' => '2',
//            'count_in_stock' => '44',
//            'status' => $statuses[array_rand($statuses)],
//        ]);
//        /* shirt orange*/
//        ProductColorSize::create([
//            'products_id' => '1',
//            'colors_id' => Color::where('hex', '#cd5b45')->first()?->id,
//            'sizes_id' => '2',
//            'count_in_stock' => '44',
//            'status' => $statuses[array_rand($statuses)],
//        ]);
    }
}

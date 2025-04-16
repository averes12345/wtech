<?php

namespace Database\Seeders;

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
        /* nike shoe */
        ProductColorSize::create([
            'products_id' => '3',
            'colors_id' => Color::where('hex', '#ba160c')->first()?->id,
            'sizes_id' => '1',
            'count_in_stock' => '34',
        ]);
         /* shoe red*/
        ProductColorSize::create([
            'products_id' => '3',
            'colors_id' => Color::where('hex', '#cf1020')->first()?->id,
            'sizes_id' => '1',
            'count_in_stock' => '34',
        ]);
         /* shoe green*/
        ProductColorSize::create([
            'products_id' => '3',
            'colors_id' => Color::where('hex', '#006a4e')->first()?->id,
            'sizes_id' => '1',
            'count_in_stock' => '34',
        ]);
         /* shoe blue*/
        ProductColorSize::create([
            'products_id' => '3',
            'colors_id' => Color::where('hex', '#004f98')->first()?->id,
            'sizes_id' => '1',
            'count_in_stock' => '34',
        ]);
         /* shoe yellow*/
        ProductColorSize::create([
            'products_id' => '3',
            'colors_id' => Color::where('hex', '#f4c430')->first()?->id,
            'sizes_id' => '1',
            'count_in_stock' => '69',
        ]);

       /* shirt green */
        ProductColorSize::create([
            'products_id' => '1',
            'colors_id' => Color::where('hex', '#355e3b')->first()?->id,
            'sizes_id' => '2',
            'count_in_stock' => '44',
        ]);
        /* shirt red */
        ProductColorSize::create([
            'products_id' => '1',
            'colors_id' => Color::where('hex', '#701c1c')->first()?->id,
            'sizes_id' => '2',
            'count_in_stock' => '44',
        ]);
        /* shirt white */
        ProductColorSize::create([
            'products_id' => '1',
            'colors_id' => Color::where('hex', '#e5e4e2')->first()?->id,
            'sizes_id' => '2',
            'count_in_stock' => '44',
        ]);
        /* shirt orange*/
        ProductColorSize::create([
            'products_id' => '1',
            'colors_id' => Color::where('hex', '#cd5b45')->first()?->id,
            'sizes_id' => '2',
            'count_in_stock' => '44',
        ]);
    }
}

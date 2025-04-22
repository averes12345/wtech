<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use colorObj;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $this->call([
        UserSeeder::class,
        CountrySeeder::class,
        BrandSeeder::class,
        CategorySeeder::class,
        ColorSeeder::class,
        SizeSeeder::class,
        ProductSeeder::class,
        ProductColorSizeSeeder::class,
        ProductImageSeeder::class,
        /* AdminSeeder::class, */
    ]);


    }
}

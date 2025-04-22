<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            'XS', 'S', 'M', 'L', 'XL', 'XXL',
            '36', '37', '38', '39', '40', '41',
            '42', '43', '44', '45', '46',
        ];

       foreach ($sizes as $size) {
           Size::updateorCreate(
               ['size' => $size],
               ['size' => $size]
           );
       }
    }
}

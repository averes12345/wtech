<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['color_name' => 'Červená', 'color_code' => '#FF0000'],
            ['color_name' => 'Zelená', 'color_code' => '#00FF00'],
            ['color_name' => 'Modrá', 'color_code' => '#0000FF'],
            ['color_name' => 'Žltá', 'color_code' => '#FFFF00'],
            ['color_name' => 'Oranžová', 'color_code' => '#FFA500'],
            ['color_name' => 'Fialová', 'color_code' => '#800080'],
            ['color_name' => 'Ružová', 'color_code' => '#FFC0CB'],
            ['color_name' => 'Hnedá', 'color_code' => '#A52A2A'],
            ['color_name' => 'Šedá', 'color_code' => '#808080'],
            ['color_name' => 'Čierna', 'color_code' => '#000000'],
        ];

        foreach ($colors as $color) {
            Color::updateOrCreate([
                'color_name' => $color['color_name'],
                'color_code' => $color['color_code'],
            ]);
        }
    }
}

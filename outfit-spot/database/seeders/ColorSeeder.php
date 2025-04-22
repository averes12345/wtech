<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//          $path = public_path('colors.csv');
//
//           if (!File::exists($path)){
//            $this->command->error("Colors CSV file not found at: $path");
//            return;
//           }
//
//           $data = array_map('str_getcsv', file($path));
//           $headers = [
//                'snake_case', 'name', 'hex', 'red', 'green', 'blue'
//           ];
//
//           /* dd($data); */
//           /* dd($headers); */
//
//           foreach ($data as $row) {
//            $record = array_combine($headers, array_map('trim', $row));


    $colors = [
        "red" => "#FF0000",
        "green" => "#00FF00",
        "blue" => "#0000FF",
        "yellow" => "#FFFF00",
        "black" => "#000000",
        "white" => "#FFFFFF",
        "gray" => "#808080",
        "orange" => "#FFA500",
        "purple" => "#800080",
        "pink" => "#FFC0CB",
        "brown" => "#A52A2A",
        ];

        foreach ($colors as $name => $hex) {
            Color::create([
                'name' => $name,
                'hex' => $hex,
           ]);
        }
    }
}

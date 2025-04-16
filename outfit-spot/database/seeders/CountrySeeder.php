<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = public_path('countries.csv');

       if (!File::exists($path)){
        $this->command->error("Country CSV file not found at: $path");
        return;
       }

       $data = array_map('str_getcsv', file($path));
       $headers = array_map('trim', array_shift($data));

       /* dd($data); */
       /* dd($headers); */

       foreach ($data as $row) {
        $record = array_combine($headers, array_map('trim', $row));

        Country::create([
            'code' => $record['alpha-2'],
            'name' => $record['name'],
       ]);
       }
    }
}

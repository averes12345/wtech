<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'jozef',
            'last_name' => 'mrkva',
            'email' => 'test-email@fake-domain.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'first_name' => 'stevo',
            'last_name' => 'zemiak',
            'email' => 'test-email2@fake-domain.com',
            'is_admin' => 'true',
            'password' => bcrypt('password'),
        ]);

        //
    }
}

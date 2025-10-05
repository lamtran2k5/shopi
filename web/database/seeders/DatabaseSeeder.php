<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Gọi các seeder khác theo thứ tự mong muốn
        $this->call([
            RolesTableSeeder::class,
            UserSeeder::class,
        ]);
    }
}

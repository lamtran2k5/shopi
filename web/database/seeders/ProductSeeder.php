<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Áo thun Laravel',
                'description' => 'Áo thun cotton 100%, in logo Laravel cực đẹp.',
                'image' => 'default.png',
                'price' => 250000,
                'shop_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mũ bảo mật CyberSec',
                'description' => 'Mũ lưỡi trai cao cấp, in logo Cyber Security.',
                'image' => 'safe.png',
                'price' => 180000,
                'shop_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cốc lập trình viên',
                'description' => 'Cốc sứ cao cấp in quote “Eat Sleep Code Repeat”.',
                'image' => 'submarine.png',
                'price' => 120000,
                'shop_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sticker Pack Hacking',
                'description' => 'Set 10 sticker về hacking & cybersecurity cực ngầu.',
                'image' => 'safe.png',
                'price' => 50000,
                'shop_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

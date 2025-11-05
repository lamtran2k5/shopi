<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin MyShoppi',
            'email' => 'admin@myshoppi.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '0901234567',
            'address' => '123 Nguyễn Huệ, Quận 1, TP.HCM',
            'avatar' => '/img/avatar.png',
        ]);

        // Create Regular Users
        $users = [
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0912345678',
                'address' => '456 Lê Lợi, Quận 1, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
            [
                'name' => 'Trần Thị B',
                'email' => 'tranthib@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0923456789',
                'address' => '789 Trần Hưng Đạo, Quận 5, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
            [
                'name' => 'Lê Văn C',
                'email' => 'levanc@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0934567890',
                'address' => '321 Võ Văn Tần, Quận 3, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
            [
                'name' => 'Phạm Thị D',
                'email' => 'phamthid@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0945678901',
                'address' => '654 Điện Biên Phủ, Quận Bình Thạnh, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
            [
                'name' => 'Hoàng Văn E',
                'email' => 'hoangvane@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0956789012',
                'address' => '147 Cách Mạng Tháng 8, Quận 10, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
            [
                'name' => 'Vũ Thị F',
                'email' => 'vuthif@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0967890123',
                'address' => '258 Nguyễn Thị Minh Khai, Quận 3, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
            [
                'name' => 'Đặng Văn G',
                'email' => 'dangvang@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0978901234',
                'address' => '369 Hai Bà Trưng, Quận 1, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
            [
                'name' => 'Bùi Thị H',
                'email' => 'buithih@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0989012345',
                'address' => '741 Lý Thường Kiệt, Quận 10, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
            [
                'name' => 'Mai Văn I',
                'email' => 'maivani@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0990123456',
                'address' => '852 Phan Xích Long, Quận Phú Nhuận, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
            [
                'name' => 'Đinh Thị K',
                'email' => 'dinhthik@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '0901234568',
                'address' => '963 Nguyễn Văn Cừ, Quận 5, TP.HCM',
                'avatar' => '/img/avatar.png',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

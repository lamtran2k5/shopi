<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Lấy role
        $adminRole = Role::where('role_name', 'Admin')->first();
        $shopRole  = Role::where('role_name', 'Shop')->first();
        $userRole  = Role::where('role_name', 'User')->first();

        if (!$adminRole || !$shopRole || !$userRole) {
            $this->command->error("Các role chưa tồn tại. Hãy chạy RolesTableSeeder trước.");
            return;
        }

        // Tạo Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'full_name' => 'Administrator',
                'password'  => 'change@me',
                'email'     => 'admin@example.com',
                'sdt'       => '0123456789',
                'address'   => 'Hanoi, Vietnam',
                'sex'       => 1,
                'background_image' => '/img/avatar.png',
                'wallet_number' => '999999999',
                'is_active' => true,
                'role_id'   => $adminRole->id
            ]
        );

        // Tạo Shop
        User::updateOrCreate(
            ['username' => 'shop1'],
            [
                'full_name' => 'Shop User',
                'password'  => 'shop@me',
                'email'     => 'shop@example.com',
                'sdt'       => '0987654321',
                'address'   => 'HCM, Vietnam',
                'sex'       => 1,
                'background_image' => '/img/avatar.png',
                'wallet_number' => '123456789',
                'is_active' => true,
                'role_id'   => $shopRole->id
            ]
        );

        // Tạo 2 user bình thường
        User::updateOrCreate(
            ['username' => 'user1'],
            [
                'full_name' => 'Normal User 1',
                'password'  => 'user@me',
                'email'     => 'user1@example.com',
                'sdt'       => '0123987654',
                'address'   => 'Da Nang, Vietnam',
                'sex'       => 0,
                'background_image' => '/img/avatar.png',
                'is_active' => true,
                'role_id'   => $userRole->id
            ]
        );

        User::updateOrCreate(
            ['username' => 'user2'],
            [
                'full_name' => 'Normal User 2',
                'password'  => 'user@me',
                'email'     => 'user2@example.com',
                'sdt'       => '0987123456',
                'address'   => 'Hai Phong, Vietnam',
                'sex'       => 0,
                'background_image' => '/img/avatar.png',
                'is_active' => true,
                'role_id'   => $userRole->id
            ]
        );

        $this->command->info('Admin, Shop và 2 User đã được tạo.');
    }
}

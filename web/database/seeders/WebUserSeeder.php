<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class WebUserSeeder extends Seeder
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
        WebUser::firstOrCreate(
            ['username' => 'admin'],
            [
                'full_name' => 'Administrator',
                'password'  => Hash::make('change@me'),
                'email'     => 'admin@example.com',
                'sdt'       => '0123456789',
                'address'   => 'Hanoi, Vietnam',
                'sex'       => 1,
                'is_active' => true,
                'role_id'   => $adminRole->id
            ]
        );

        // Tạo Shop
        WebUser::firstOrCreate(
            ['username' => 'shop1'],
            [
                'full_name' => 'Shop User',
                'password'  => Hash::make('shop@me'),
                'email'     => 'shop@example.com',
                'sdt'       => '0987654321',
                'address'   => 'HCM, Vietnam',
                'sex'       => 1,
                'is_active' => true,
                'role_id'   => $shopRole->id
            ]
        );

        // Tạo 2 user bình thường
        WebUser::firstOrCreate(
            ['username' => 'user1'],
            [
                'full_name' => 'Normal User 1',
                'password'  => Hash::make('user@me'),
                'email'     => 'user1@example.com',
                'sdt'       => '0123987654',
                'address'   => 'Da Nang, Vietnam',
                'sex'       => 0,
                'is_active' => true,
                'role_id'   => $userRole->id
            ]
        );

        WebUser::firstOrCreate(
            ['username' => 'user2'],
            [
                'full_name' => 'Normal User 2',
                'password'  => Hash::make('user@me'),
                'email'     => 'user2@example.com',
                'sdt'       => '0987123456',
                'address'   => 'Hai Phong, Vietnam',
                'sex'       => 0,
                'is_active' => true,
                'role_id'   => $userRole->id
            ]
        );

        $this->command->info('Admin, Shop và 2 User đã được tạo.');
    }
}

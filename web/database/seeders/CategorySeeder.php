<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Áo Nam',
                'slug' => 'ao-nam',
                'image' => '/category/ao_nam_danh_muc.jpg',
                'description' => 'Các loại áo thời trang dành cho nam giới',
                'is_active' => true
            ],
            [
                'name' => 'Áo Nữ',
                'slug' => 'ao-nu',
                'image' => '/category/ao_nu_danh_muc.jpg',
                'description' => 'Các loại áo thời trang dành cho nữ giới',
                'is_active' => true
            ],
            [
                'name' => 'Quần Jean',
                'slug' => 'quan-jean',
                'image' => '/category/quan_jean_danh_muc.jpg',
                'description' => 'Quần jean nam nữ đa dạng kiểu dáng',
                'is_active' => true
            ],
            [
                'name' => 'Quần Short',
                'slug' => 'quan-short',
                'image' => '/category/quan_short_danh_muc.jpg',
                'description' => 'Quần short thể thao, dạo phố',
                'is_active' => true
            ],
            [
                'name' => 'Váy Đầm',
                'slug' => 'vay-dam',
                'image' => '/category/quan_short_danh_muc.jpg',
                'description' => 'Váy đầm công sở, dự tiệc',
                'is_active' => true
            ],
            [
                'name' => 'Áo Khoác',
                'slug' => 'ao-khoac',
                'image' => '/category/ao_khoac_danh_muc.jpg',
                'description' => 'Áo khoác mùa đông, áo khoác jean',
                'is_active' => true
            ],
            [
                'name' => 'Giày Sneaker',
                'slug' => 'giay-sneaker',
                'image' => '/category/giay_sneaker_danh_muc.jpg',
                'description' => 'Giày thể thao nam nữ',
                'is_active' => true
            ],
            [
                'name' => 'Túi Xách',
                'slug' => 'tui-xach',
                'image' => '/category/tui_xach_danh_muc.jpg',
                'description' => 'Túi xách thời trang cao cấp',
                'is_active' => true
            ],
            [
                'name' => 'Phụ Kiện',
                'slug' => 'phu-kien',
                'image' => '/category/mu_danh_muc.jpg',
                'description' => 'Phụ kiện thời trang: mũ, thắt lưng, ví',
                'is_active' => true
            ],
            [
                'name' => 'Đồ Thể Thao',
                'slug' => 'do-the-thao',
                'image' => '/category/bo_do_the_thao_danh_muc.jpg',
                'description' => 'Quần áo thể thao, gym, yoga',
                'is_active' => true
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Áo Nam
            [
                'category_id' => 1,
                'name' => 'Áo Thun Nam Basic Trắng',
                'description' => 'Áo thun nam cotton 100%, form regular fit thoải mái',
                'price' => 199000,
                'sale_price' => 149000,
                'stock' => 50,
                'image' => '/product/ao_thun_nam_basic_trang.jpeg',
                'is_featured' => true,
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Áo Polo Nam Cao Cấp',
                'description' => 'Áo polo nam chất liệu pique cotton thoáng mát',
                'price' => 350000,
                'sale_price' => 280000,
                'stock' => 30,
                'image' => '/product/ao_polo_nam.jpg',
                'is_featured' => true,
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Áo Sơ Mi Nam Trắng',
                'description' => 'Áo sơ mi nam công sở, chất liệu kate mềm mại',
                'price' => 450000,
                'sale_price' => null,
                'stock' => 25,
                'image' => '/product/ao_so_mi_nam_trang.jpg',
                'is_featured' => false,
                'is_active' => true
            ],

            // Áo Nữ
            [
                'category_id' => 2,
                'name' => 'Áo Kiểu Nữ Hoa Nhí',
                'description' => 'Áo kiểu nữ họa tiết hoa nhí vintage xinh xắn',
                'price' => 299000,
                'sale_price' => 199000,
                'stock' => 40,
                'image' => '/product/ao_kieu_nu_hoa_nhi.jpg',
                'is_featured' => true,
                'is_active' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Áo Thun Nữ Form Rộng',
                'description' => 'Áo thun nữ form rộng phong cách Hàn Quốc',
                'price' => 189000,
                'sale_price' => 149000,
                'stock' => 60,
                'image' => '/product/ao_thun_nu_form_rong.jpg',
                'is_featured' => false,
                'is_active' => true
            ],

            // Quần Jean
            [
                'category_id' => 3,
                'name' => 'Quần Jean Nam Slim Fit Xanh Đen',
                'description' => 'Quần jean nam slim fit co giãn, wash đẹp',
                'price' => 550000,
                'sale_price' => 449000,
                'stock' => 35,
                'image' => '/product/quan_jean_nam_slimfit.jpg',
                'is_featured' => true,
                'is_active' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Quần Jean Nữ Ống Rộng',
                'description' => 'Quần jean nữ ống rộng vintage phong cách retro',
                'price' => 590000,
                'sale_price' => 490000,
                'stock' => 28,
                'image' => '/product/quan_jean_nu_ong_rong.jpg',
                'is_featured' => false,
                'is_active' => true
            ],

            // Quần Short
            [
                'category_id' => 4,
                'name' => 'Quần Short Kaki Nam',
                'description' => 'Quần short kaki nam đi chơi, dạo phố',
                'price' => 280000,
                'sale_price' => null,
                'stock' => 45,
                'image' => '/product/quan_short_kaki_nam.jpg',
                'is_featured' => false,
                'is_active' => true
            ],

            // Váy Đầm
            [
                'category_id' => 5,
                'name' => 'Váy Đầm Maxi Hoa',
                'description' => 'Váy đầm maxi họa tiết hoa dự tiệc sang trọng',
                'price' => 690000,
                'sale_price' => 550000,
                'stock' => 20,
                'image' => '/product/vay_dam_maxi_hoa.jpg',
                'is_featured' => true,
                'is_active' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Váy Công Sở Đen',
                'description' => 'Váy đen công sở thanh lịch, chuyên nghiệp',
                'price' => 450000,
                'sale_price' => null,
                'stock' => 32,
                'image' => '/product/vay_cong_so_den.jpeg',
                'is_featured' => false,
                'is_active' => true
            ],

            // Áo Khoác
            [
                'category_id' => 6,
                'name' => 'Áo Khoác Jean Nam',
                'description' => 'Áo khoác jean nam wash nhẹ phong cách',
                'price' => 750000,
                'sale_price' => 599000,
                'stock' => 22,
                'image' => '/product/ao_khoac_jean_nam.jpg',
                'is_featured' => true,
                'is_active' => true
            ],

            // Giày Sneaker
            [
                'category_id' => 7,
                'name' => 'Giày Sneaker Trắng Unisex',
                'description' => 'Giày sneaker basic màu trắng đế cao su',
                'price' => 450000,
                'sale_price' => 350000,
                'stock' => 55,
                'image' => '/product/giay_sneaker_trang.jpg',
                'is_featured' => true,
                'is_active' => true
            ],

            // Túi Xách
            [
                'category_id' => 8,
                'name' => 'Túi Xách Nữ Da PU',
                'description' => 'Túi xách nữ da PU cao cấp nhiều ngăn',
                'price' => 890000,
                'sale_price' => 690000,
                'stock' => 18,
                'image' => '/product/tui_xach_nu_pu.jpg',
                'is_featured' => true,
                'is_active' => true
            ],

            // Phụ Kiện
            [
                'category_id' => 9,
                'name' => 'Mũ Lưỡi Trai Thêu',
                'description' => 'Mũ lưỡi trai thêu logo độc đáo',
                'price' => 150000,
                'sale_price' => 99000,
                'stock' => 70,
                'image' => '/product/mu_luoi_trai_theu.jpg',
                'is_featured' => false,
                'is_active' => true
            ],

            // Đồ Thể Thao
            [
                'category_id' => 10,
                'name' => 'Bộ Đồ Gym Nam',
                'description' => 'Bộ quần áo gym nam thể thao co giãn 4 chiều',
                'price' => 490000,
                'sale_price' => 399000,
                'stock' => 38,
                'image' => '/product/do_gym_nam.jpg',
                'is_featured' => false,
                'is_active' => true
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

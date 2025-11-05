<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'user_id' => 1,
            'order_number' => Str::uuid(),
            'subtotal' => 450000,
            'shipping_fee' => 30000,
            'total_amount' => 480000,
            'status' => 'pending',
            'payment_method' => 'COD',
            'customer_name' => 'Admin MyShoppi',
            'customer_phone' => '0901234567',
            'customer_email' => 'admin@myshoppi.com',
            'shipping_address' => '123 Nguyễn Huệ, Quận 1, TP.HCM',
            'note' => 'Đơn hàng test của admin',
        ]);

        Order::create([
            'user_id' => 2,
            'order_number' => Str::uuid(),
            'subtotal' => 320000,
            'shipping_fee' => 20000,
            'total_amount' => 340000,
            'status' => 'processing',
            'payment_method' => 'momo',
            'customer_name' => 'Nguyễn Văn A',
            'customer_phone' => '0912345678',
            'customer_email' => 'nguyenvana@gmail.com',
            'shipping_address' => '456 Lê Lợi, Quận 1, TP.HCM',
            'note' => 'Giao trong giờ hành chính',
        ]);

        Order::create([
            'user_id' => 3,
            'order_number' => Str::uuid(),
            'subtotal' => 550000,
            'shipping_fee' => 30000,
            'total_amount' => 580000,
            'status' => 'delivered',
            'payment_method' => 'bank_transfer',
            'customer_name' => 'Trần Thị B',
            'customer_phone' => '0923456789',
            'customer_email' => 'tranthib@gmail.com',
            'shipping_address' => '789 Trần Hưng Đạo, Quận 5, TP.HCM',
            'note' => 'Khách dễ tính',
        ]);

        Order::create([
            'user_id' => 4,
            'order_number' => Str::uuid(),
            'subtotal' => 210000,
            'shipping_fee' => 15000,
            'total_amount' => 225000,
            'status' => 'pending',
            'payment_method' => 'COD',
            'customer_name' => 'Lê Văn C',
            'customer_phone' => '0934567890',
            'customer_email' => 'levanc@gmail.com',
            'shipping_address' => '321 Võ Văn Tần, Quận 3, TP.HCM',
            'note' => null,
        ]);

        Order::create([
            'user_id' => 5,
            'order_number' => Str::uuid(),
            'subtotal' => 600000,
            'shipping_fee' => 30000,
            'total_amount' => 630000,
            'status' => 'shipped',
            'payment_method' => 'vnpay',
            'customer_name' => 'Phạm Thị D',
            'customer_phone' => '0945678901',
            'customer_email' => 'phamthid@gmail.com',
            'shipping_address' => '654 Điện Biên Phủ, Quận Bình Thạnh, TP.HCM',
            'note' => null,
        ]);

        Order::create([
            'user_id' => 6,
            'order_number' => Str::uuid(),
            'subtotal' => 290000,
            'shipping_fee' => 20000,
            'total_amount' => 310000,
            'status' => 'cancelled',
            'payment_method' => 'COD',
            'customer_name' => 'Hoàng Văn E',
            'customer_phone' => '0956789012',
            'customer_email' => 'hoangvane@gmail.com',
            'shipping_address' => '147 Cách Mạng Tháng 8, Quận 10, TP.HCM',
            'note' => 'Khách hủy đơn',
        ]);

        Order::create([
            'user_id' => 7,
            'order_number' => Str::uuid(),
            'subtotal' => 400000,
            'shipping_fee' => 25000,
            'total_amount' => 425000,
            'status' => 'processing',
            'payment_method' => 'momo',
            'customer_name' => 'Vũ Thị F',
            'customer_phone' => '0967890123',
            'customer_email' => 'vuthif@gmail.com',
            'shipping_address' => '258 Nguyễn Thị Minh Khai, Quận 3, TP.HCM',
            'note' => null,
        ]);

        Order::create([
            'user_id' => 8,
            'order_number' => Str::uuid(),
            'subtotal' => 360000,
            'shipping_fee' => 20000,
            'total_amount' => 380000,
            'status' => 'pending',
            'payment_method' => 'bank_transfer',
            'customer_name' => 'Đặng Văn G',
            'customer_phone' => '0978901234',
            'customer_email' => 'dangvang@gmail.com',
            'shipping_address' => '369 Hai Bà Trưng, Quận 1, TP.HCM',
            'note' => 'Liên hệ trước khi giao',
        ]);

        Order::create([
            'user_id' => 9,
            'order_number' => Str::uuid(),
            'subtotal' => 270000,
            'shipping_fee' => 15000,
            'total_amount' => 285000,
            'status' => 'shipped',
            'payment_method' => 'vnpay',
            'customer_name' => 'Bùi Thị H',
            'customer_phone' => '0989012345',
            'customer_email' => 'buithih@gmail.com',
            'shipping_address' => '741 Lý Thường Kiệt, Quận 10, TP.HCM',
            'note' => null,
        ]);

        Order::create([
            'user_id' => 10,
            'order_number' => Str::uuid(),
            'subtotal' => 310000,
            'shipping_fee' => 20000,
            'total_amount' => 330000,
            'status' => 'delivered',
            'payment_method' => 'COD',
            'customer_name' => 'Mai Văn I',
            'customer_phone' => '0990123456',
            'customer_email' => 'maivani@gmail.com',
            'shipping_address' => '852 Phan Xích Long, Quận Phú Nhuận, TP.HCM',
            'note' => null,
        ]);

        Order::create([
            'user_id' => 11,
            'order_number' => Str::uuid(),
            'subtotal' => 500000,
            'shipping_fee' => 30000,
            'total_amount' => 530000,
            'status' => 'processing',
            'payment_method' => 'momo',
            'customer_name' => 'Đinh Thị K',
            'customer_phone' => '0901234568',
            'customer_email' => 'dinhthik@gmail.com',
            'shipping_address' => '963 Nguyễn Văn Cừ, Quận 5, TP.HCM',
            'note' => null,
        ]);
    }
}

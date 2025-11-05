<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Order 1
        OrderItem::create([
            'order_id' => 1,
            'product_id' => 1,
            'product_name' => 'Áo thun trắng basic',
            'price' => 199000,
            'quantity' => 2,
            'total' => 398000,
        ]);
        OrderItem::create([
            'order_id' => 1,
            'product_id' => 2,
            'product_name' => 'Quần short kaki',
            'price' => 250000,
            'quantity' => 1,
            'total' => 250000,
        ]);

        // Order 2
        OrderItem::create([
            'order_id' => 2,
            'product_id' => 3,
            'product_name' => 'Áo sơ mi caro',
            'price' => 299000,
            'quantity' => 1,
            'total' => 299000,
        ]);
        OrderItem::create([
            'order_id' => 2,
            'product_id' => 5,
            'product_name' => 'Giày sneaker trắng',
            'price' => 550000,
            'quantity' => 1,
            'total' => 550000,
        ]);

        // Order 3
        OrderItem::create([
            'order_id' => 3,
            'product_id' => 6,
            'product_name' => 'Balo laptop thời trang',
            'price' => 420000,
            'quantity' => 1,
            'total' => 420000,
        ]);

        // Order 4
        OrderItem::create([
            'order_id' => 4,
            'product_id' => 8,
            'product_name' => 'Mũ lưỡi trai đen',
            'price' => 120000,
            'quantity' => 2,
            'total' => 240000,
        ]);
        OrderItem::create([
            'order_id' => 4,
            'product_id' => 9,
            'product_name' => 'Đồng hồ dây da nâu',
            'price' => 850000,
            'quantity' => 1,
            'total' => 850000,
        ]);

        // Order 5
        OrderItem::create([
            'order_id' => 5,
            'product_id' => 4,
            'product_name' => 'Áo khoác gió xanh',
            'price' => 499000,
            'quantity' => 1,
            'total' => 499000,
        ]);
        OrderItem::create([
            'order_id' => 5,
            'product_id' => 10,
            'product_name' => 'Ví da nam cao cấp',
            'price' => 450000,
            'quantity' => 1,
            'total' => 450000,
        ]);

        // Order 6
        OrderItem::create([
            'order_id' => 6,
            'product_id' => 7,
            'product_name' => 'Tai nghe Bluetooth',
            'price' => 320000,
            'quantity' => 2,
            'total' => 640000,
        ]);

        // Order 7
        OrderItem::create([
            'order_id' => 7,
            'product_id' => 11,
            'product_name' => 'Thắt lưng da bò',
            'price' => 350000,
            'quantity' => 1,
            'total' => 350000,
        ]);
        OrderItem::create([
            'order_id' => 7,
            'product_id' => 12,
            'product_name' => 'Cáp sạc nhanh USB-C',
            'price' => 99000,
            'quantity' => 1,
            'total' => 99000,
        ]);

        // Order 8
        OrderItem::create([
            'order_id' => 8,
            'product_id' => 13,
            'product_name' => 'Nón bucket thời trang',
            'price' => 150000,
            'quantity' => 1,
            'total' => 150000,
        ]);

        // Order 9
        OrderItem::create([
            'order_id' => 9,
            'product_id' => 14,
            'product_name' => 'Dép quai ngang nam',
            'price' => 220000,
            'quantity' => 2,
            'total' => 440000,
        ]);

        // Order 10
        OrderItem::create([
            'order_id' => 10,
            'product_id' => 15,
            'product_name' => 'Áo hoodie oversize',
            'price' => 399000,
            'quantity' => 1,
            'total' => 399000,
        ]);
        OrderItem::create([
            'order_id' => 10,
            'product_id' => 1,
            'product_name' => 'Áo thun basic đen',
            'price' => 199000,
            'quantity' => 1,
            'total' => 199000,
        ]);

        // Order 11
        OrderItem::create([
            'order_id' => 11,
            'product_id' => 2,
            'product_name' => 'Quần short jean xanh',
            'price' => 270000,
            'quantity' => 1,
            'total' => 270000,
        ]);
        OrderItem::create([
            'order_id' => 11,
            'product_id' => 3,
            'product_name' => 'Áo sơ mi trắng trơn',
            'price' => 299000,
            'quantity' => 1,
            'total' => 299000,
        ]);
    }
}

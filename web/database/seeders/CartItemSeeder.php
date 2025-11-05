<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartItem;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cart 1
        CartItem::create(['cart_id' => 1, 'product_id' => 1, 'quantity' => 2]);
        CartItem::create(['cart_id' => 1, 'product_id' => 2, 'quantity' => 1]);
        CartItem::create(['cart_id' => 1, 'product_id' => 3, 'quantity' => 4]);

        // Cart 2
        CartItem::create(['cart_id' => 2, 'product_id' => 4, 'quantity' => 2]);
        CartItem::create(['cart_id' => 2, 'product_id' => 5, 'quantity' => 3]);
        CartItem::create(['cart_id' => 2, 'product_id' => 6, 'quantity' => 1]);

        // Cart 3
        CartItem::create(['cart_id' => 3, 'product_id' => 7, 'quantity' => 2]);
        CartItem::create(['cart_id' => 3, 'product_id' => 8, 'quantity' => 1]);
        CartItem::create(['cart_id' => 3, 'product_id' => 9, 'quantity' => 5]);

        // Cart 4
        CartItem::create(['cart_id' => 4, 'product_id' => 10, 'quantity' => 3]);
        CartItem::create(['cart_id' => 4, 'product_id' => 11, 'quantity' => 2]);
        CartItem::create(['cart_id' => 4, 'product_id' => 12, 'quantity' => 1]);

        // Cart 5
        CartItem::create(['cart_id' => 5, 'product_id' => 13, 'quantity' => 4]);
        CartItem::create(['cart_id' => 5, 'product_id' => 14, 'quantity' => 1]);
        CartItem::create(['cart_id' => 5, 'product_id' => 15, 'quantity' => 2]);

        // Cart 6
        CartItem::create(['cart_id' => 6, 'product_id' => 1, 'quantity' => 2]);
        CartItem::create(['cart_id' => 6, 'product_id' => 4, 'quantity' => 3]);
        CartItem::create(['cart_id' => 6, 'product_id' => 7, 'quantity' => 1]);

        // Cart 7
        CartItem::create(['cart_id' => 7, 'product_id' => 2, 'quantity' => 1]);
        CartItem::create(['cart_id' => 7, 'product_id' => 5, 'quantity' => 4]);
        CartItem::create(['cart_id' => 7, 'product_id' => 8, 'quantity' => 2]);

        // Cart 8
        CartItem::create(['cart_id' => 8, 'product_id' => 3, 'quantity' => 3]);
        CartItem::create(['cart_id' => 8, 'product_id' => 6, 'quantity' => 2]);
        CartItem::create(['cart_id' => 8, 'product_id' => 9, 'quantity' => 1]);

        // Cart 9
        CartItem::create(['cart_id' => 9, 'product_id' => 10, 'quantity' => 2]);
        CartItem::create(['cart_id' => 9, 'product_id' => 13, 'quantity' => 5]);
        CartItem::create(['cart_id' => 9, 'product_id' => 15, 'quantity' => 1]);

        // Cart 10
        CartItem::create(['cart_id' => 10, 'product_id' => 11, 'quantity' => 1]);
        CartItem::create(['cart_id' => 10, 'product_id' => 12, 'quantity' => 3]);
        CartItem::create(['cart_id' => 10, 'product_id' => 14, 'quantity' => 2]);

        // Cart 11
        CartItem::create(['cart_id' => 11, 'product_id' => 1, 'quantity' => 4]);
        CartItem::create(['cart_id' => 11, 'product_id' => 5, 'quantity' => 2]);
        CartItem::create(['cart_id' => 11, 'product_id' => 9, 'quantity' => 1]);
    }
}

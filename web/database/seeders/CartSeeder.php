<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::create(['user_id' => 1]);
        Cart::create(['user_id' => 2]);
        Cart::create(['user_id' => 3]);
        Cart::create(['user_id' => 4]);
        Cart::create(['user_id' => 5]);
        Cart::create(['user_id' => 6]);
        Cart::create(['user_id' => 7]);
        Cart::create(['user_id' => 8]);
        Cart::create(['user_id' => 9]);
        Cart::create(['user_id' => 10]);
        Cart::create(['user_id' => 11]);
    }
}

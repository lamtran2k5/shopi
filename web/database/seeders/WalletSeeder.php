<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Wallet;


class WalletSeeder extends Seeder
{
    public function run()
    {
        Wallet::create([
            'wallet_number' => '999999999',
            'wallet_balance' => 1000000,
        ]);
        Wallet::create([
            'wallet_number' => '123456789',
            'wallet_balance' => 1000000,
        ]);
    }
}
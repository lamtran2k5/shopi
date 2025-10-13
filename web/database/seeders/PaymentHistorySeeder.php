<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\PaymentHistory;


class PaymentHistorySeeder extends Seeder
{
    public function run()
    {
        PaymentHistory::create([
            'wallet_number' => '999999999',
            'amount' => 1000000,
        ]);
    }
}
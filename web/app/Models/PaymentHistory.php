<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'payment_history';

    // Các field có thể gán hàng loạt
    protected $fillable = [
        'wallet_number',
        'amount',
    ];

    public function Wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_number', 'wallet_number');

    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallet';

    protected $primaryKey = 'wallet_number';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // Các cột có thể gán hàng loạt
    protected $fillable = [
        'wallet_number',
        'account_balance',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'wallet_number');
    }
}

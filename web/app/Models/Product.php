<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'products';

    // Các field có thể gán hàng loạt
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
    ];
}
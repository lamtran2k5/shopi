<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    // Tên bảng, nếu không Laravel sẽ tự hiểu là "web_users"
    protected $table = 'users';

    // Các field có thể gán giá trị hàng loạt
    protected $fillable = [
        'full_name',
        'username',
        'password',
        'email',
        'sdt',
        'address',
        'sex',
        'wallet_number',
        'is_active',
    ];

    // Các field sẽ bị ẩn khi trả về JSON
    protected $hidden = [
        'password'
    ];

    // Ép kiểu dữ liệu
    protected $casts = [
        'sex' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Mutator để tự động hash password khi tạo hoặc cập nhật
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Relationship: một user thuộc về một role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_number', 'wallet_number');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'permissions';

    // Các field có thể gán hàng loạt
    protected $fillable = [
        'permission_name',
        'description',
    ];

    // Relationship: nhiều permission có thể gán cho nhiều role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}

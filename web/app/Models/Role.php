<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    // Các field có thể gán hàng loạt
    protected $fillable = [
        'role_name',
    ];

    public $timestamps = false;

    // Relationship: một role có nhiều user
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relationship: một role có nhiều permission qua bảng trung gian role_permission
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}

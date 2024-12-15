<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Các thuộc tính có thể điền (fillable)
    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'user_name',
        'password',
    ];

    // Ẩn các trường khi trả về JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UserModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'user_name',
        'password',
        'is_admin',
        'answered',
        'start_date',
    ];

    public static function getAllUsers()
    {
        return self::all();
    }
}

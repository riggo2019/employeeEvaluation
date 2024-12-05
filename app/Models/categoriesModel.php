<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class categoriesModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
    ];
}

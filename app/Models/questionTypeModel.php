<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class questionTypeModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'question_types';

    protected $fillable = [
        'type_name',
    ];
}

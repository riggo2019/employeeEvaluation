<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class questionsModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'questions';

    protected $fillable = [
        'question_content',
        'category_id ',
    ];
}

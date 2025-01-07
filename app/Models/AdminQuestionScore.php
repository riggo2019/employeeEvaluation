<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class AdminQuestionScore extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'admin_question_scores';

    protected $fillable = ['admin_id', 'user_id', 'question_id', 'score'];
}
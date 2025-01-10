<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class AdminScore extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'admin_scores';

    protected $fillable = ['admin_id', 'user_id', 'category_id', 'average_score'];
}
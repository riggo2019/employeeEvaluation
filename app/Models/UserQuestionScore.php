<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestionScore extends Model
{
    use HasFactory;

    protected $table = 'user_question_scores'; // Tên bảng
    protected $fillable = ['user_id', 'question_id', 'score']; // Các cột có thể được gán giá trị

    public $timestamps = true; // Sử dụng `created_at` và `updated_at`
}

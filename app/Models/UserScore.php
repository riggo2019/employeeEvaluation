<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    use HasFactory;

    protected $table = 'user_scores'; // Tên bảng
    protected $fillable = ['user_id', 'category_id', 'average_score']; // Các cột có thể được gán giá trị

    public $timestamps = true; // Sử dụng `created_at` và `updated_at`
}

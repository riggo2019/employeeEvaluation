<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['sku', 'price'];

    // Mối quan hệ với bảng sản phẩm
    public function translations()
    {
        return $this->hasMany(QuestionTranslation::class);
    }

    // Lấy tên sản phẩm dựa trên ngôn ngữ hiện tại
    public function getQuestionContentAttribute()
    {
        return $this->translations()->where('locale', app()->getLocale())->first()->question_content ?? $this->translations()->where('locale', 'vi')->first()->question_content;
    }

}

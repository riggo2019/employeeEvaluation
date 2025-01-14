<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    protected $table = 'question_translations';
    
    protected $fillable = ['question_id', 'locale', 'question_content'];
    
    // Mối quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Question::class);
    }
}
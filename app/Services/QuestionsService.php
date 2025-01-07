<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class QuestionsService
{
    public function getQuestionsByCategory($category_id = null)
    {
        $query = DB::table('categories')->select('categories.*', 'questions.*', 'questions.id as question_id')
        ->join('questions', 'questions.category_id', '=', 'categories.id'); // Khởi tạo query builder

        // Thêm các điều kiện nếu có
        if (!empty($category_id)) {
            $query->where('categories.id', '=', $category_id);
        }

        return $query->get(); // Trả về kết quả
    }

    public function getQuestions($category_id = null)
    {
        $query = DB::table('questions')->select(
            'questions.id',
            'questions.question_content',
            'questions.category_id',
            )
        ->join('categories', 'questions.category_id', '=', 'categories.id');

        if (!empty($category_id)) {
            $query->where('categories.id', '=', $category_id);
        }

        return $query->get(); 
    }
}

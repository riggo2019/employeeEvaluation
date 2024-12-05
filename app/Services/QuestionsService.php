<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class QuestionsService
{
    public function getQuestionsByCategory($category_id = null)
    {
        $query = DB::table('categories')->select('categories.*', 'questions.*', 'questions.id as question_id')
        ->leftJoin('questions', 'questions.category_id', '=', 'categories.id'); // Khởi tạo query builder

        // Thêm các điều kiện nếu có
        if (!empty($category)) {
            $query->where('categories.id', '=', $category);
        }

        return $query->get(); // Trả về kết quả
    }
}

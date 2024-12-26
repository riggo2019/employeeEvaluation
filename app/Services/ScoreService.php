<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class ScoreService
{
    public function getScoresWithCategories($user_id = null)
    {
            $query = DB::table('user_scores')->select('user_scores.*', 'categories.*')
            ->join('categories', 'user_scores.category_id', '=', 'categories.id') // Khởi tạo query builder
            ->orderBy('user_scores.category_id');
            if (!empty($user_id)) {
                $query->where('user_scores.user_id', '=', $user_id);
            }
            return $query->get();
    }

    public function getListOfScore($category_id = null, $user_id = null)
    {
            $query = DB::table('user_question_scores')->select(
                'user_question_scores.user_id',
                'user_question_scores.score',
                'questions.question_content',
                'categories.category_name',
                'questions.category_id',
                DB::raw("DATE_FORMAT(user_question_scores.created_at, '%d/%m/%Y') as answer_date"))
            ->join('questions', 'user_question_scores.question_id', '=', 'questions.id') // Khởi tạo query builder
            ->join('categories', 'questions.category_id', '=', 'categories.id') // Khởi tạo query builder
            ->orderBy('questions.category_id');
            if (!empty($category_id)) {
                $query->where('questions.category_id', '=', $category_id);
            }
            if (!empty($user_id)) {
                $query->where('user_question_scores.user_id', '=', $user_id);
            }
            return $query->get();
    }
}

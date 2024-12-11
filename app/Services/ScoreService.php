<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class ScoreService
{
    public function getScoresWithCategories($user_id = null)
    {
            $query = DB::table('user_scores')->select('user_scores.*', 'categories.*')
            ->join('categories', 'user_scores.category_id', '=', 'categories.id'); // Khởi tạo query builder
    
            if (!empty($user_id)) {
                $query->where('user_scores.user_id', '=', $user_id);
            }
            return $query->get(); // Trả về kết quả
    }
}

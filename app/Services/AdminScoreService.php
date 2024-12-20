<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AdminScoreService
{
    public function getUserFullInfo($user_id = null)
    {
        $query = DB::table('users')->select(
            'users.*',
            'departments.*',
            DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name")
        )
            ->join('departments', 'users.department_id', '=', 'departments.id'); // Khởi tạo query builder

        if (!empty($user_id)) {
            $query->where('users.id', '=', $user_id);
            return $query->first();
        }
        return $query->get(); // Trả về kết quả
    }
}
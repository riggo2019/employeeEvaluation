<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class UserService
{
    public function getUserFullInfo($user_id = null)
    {
        $query = DB::table('users')->select(
            'users.*',
            'departments.*',
            DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
            DB::raw("DATE_FORMAT(users.start_date, '%d/%m/%Y') AS formatted_start_date")
        )
            ->join('departments', 'users.department_id', '=', 'departments.id'); // Khởi tạo query builder

        if (!empty($user_id)) {
            $query->where('users.id', '=', $user_id);
            return $query->first();
        }
        return $query->get(); // Trả về kết quả
    }

    public function getEmployeeFullInfo($user_id = null)
    {
        $query = DB::table('users')->select(
            'users.*',
            'departments.department_name',
            DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS full_name"),
            DB::raw("DATE_FORMAT(users.start_date, '%d/%m/%Y') AS formatted_start_date")
        )
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->where('users.is_admin', '0');

        if (!empty($user_id)) {
            $query->where('users.id', '=', $user_id);
            return $query->first();
        }
        return $query->get(); // Trả về kết quả
    }
}

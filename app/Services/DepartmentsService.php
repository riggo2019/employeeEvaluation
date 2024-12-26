<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DepartmentsService
{
    public function getDepartmentList()
    {
        return DB::table('departments')->select('departments.department_name')->get(); // Trả về kết quả
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DepartmentsService
{
    public function getDepartmentNotAdminList()
    {
        return DB::table('departments')->select('departments.id','departments.department_name')->where('departments.id', '!=', '5')->get(); // Trả về kết quả
    }
}

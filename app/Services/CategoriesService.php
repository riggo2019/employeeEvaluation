<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CategoriesService
{
    public function getCategoriesList()
    {
        return DB::table('categories')->select('categories.category_name')
        ->where('')->get(); // Trả về kết quả
    }
}

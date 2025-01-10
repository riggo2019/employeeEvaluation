<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CategoriesService
{
    public function getCategoriesList()
    {
        $query = DB::table('categories')->select(
            'categories.id', 
            'categories.category_name'
        );
        
        return $query->get(); 
    }
}

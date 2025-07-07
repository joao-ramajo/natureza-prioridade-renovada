<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class CategoryService
{
    public function getAllCategoriesWithPointExists()
    {
        return Category::has('collectionPoints')->get();
    }

    public function getAllCategories(){
        return Category::all();
    }
}

<?php

namespace App\Classes\Services;

use App\Models\Category;

class CategoryService
{
    public function getAllCategory()
    {
        $category = Category::orderBy('id', 'desc')->paginate(15);
        return $category;
    }

    public function createCategory(array $data)
    {
        Category::create([
            "name" => $data['name'],
            "parent_id" => $data['parent_id'],
        ]);
        $msg = "category is created successfully";
        return $msg;
    }
}

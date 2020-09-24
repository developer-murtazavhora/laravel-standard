<?php

namespace App\Repositories\API;

use App\Models\Category;

class CategoriesRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategories()
    {
        return $this->category->where('is_active', 1)->get()->toArray();
    }
}

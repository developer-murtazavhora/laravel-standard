<?php

namespace App\Repositories;

use App\Interfaces\CategoriesInterface;
use App\Models\Category;

class CategoriesRepository implements CategoriesInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategories()
    {
        return $this->category->with(['user', 'products.product'])->get();
    }

    public function getCategoryById($id)
    {
        return $this->category->with(['user', 'products.product'])->findOrFail($id);
    }

    public function store($data)
    {
        return $this->category->create($data);
    }

    public function update($data, $id)
    {
        return $this->category->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return $this->category->findOrFail($id)->delete();
    }
}

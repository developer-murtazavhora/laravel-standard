<?php

namespace App\Interfaces;

interface CategoriesInterface
{
    public function getCategories();

    public function getCategoryById($id);

    public function store($data);

    public function update($data, $id);

    public function delete($id);
}

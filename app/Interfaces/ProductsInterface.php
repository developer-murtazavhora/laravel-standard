<?php

namespace App\Interfaces;

interface ProductsInterface
{
    public function getProducts();

    public function getProductById($id);

    public function store($data);

    public function update($data, $id);

    public function delete($id);
}

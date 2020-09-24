<?php

namespace App\Repositories;

use App\Interfaces\ProductsInterface;
use App\Models\Product;

class ProductsRepository implements ProductsInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProducts()
    {
        return $this->product->with(['user', 'categories.category'])->get();
    }

    public function getProductById($id)
    {
        return $this->product->with(['user', 'categories.category'])->findOrFail($id);
    }

    public function store($data)
    {
        return $this->product->create($data);
    }

    public function update($data, $id)
    {
        return $this->product->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return $this->product->findOrFail($id)->delete();
    }
}

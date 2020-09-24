<?php

namespace App\Repositories\API;

use App\Models\Product;
use App\Models\ProductHasCategory;

class ProductsRepository
{
    protected $product, $product_has_category;

    public function __construct(Product $product, ProductHasCategory $product_has_category)
    {
        $this->product              = $product;
        $this->product_has_category = $product_has_category;
    }

    public function getProductsByCategory($category_id = 0)
    {
        return $this->product_has_category
            ->with('product')
            ->where('category_id', $category_id)
            ->get();
    }

    public function getProductByKeyword($keyword = '')
    {
        return $this->product
            ->where('title', 'like', '%' . $keyword . '%')
            ->get();
    }

    public function getProductDetail($product_id = 0)
    {
        return $this->product->findOrFail($product_id);
    }
}

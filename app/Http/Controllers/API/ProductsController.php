<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\API\ProductsRepository;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $products_repository;

    public function __construct(ProductsRepository $products_repository)
    {
        $this->products_repository = $products_repository;
    }

    public function getProductsByCategory(Request $request, $category_id)
    {
        try {
            $products = $this->products_repository->getProductsByCategory($category_id);
            return response()
                ->json([
                    'success' => true,
                    'code'    => 200,
                    'message' => 'Products.',
                    'data'    => $products
                ]);
        } catch (\Exception $e) {
            return response()
                ->json([
                    'success' => false,
                    'code'    => $e->getCode(),
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function getProductByKeyword(Request $request, $keyword)
    {
        try {
            $products = $this->products_repository->getProductByKeyword($keyword);
            return response()
                ->json([
                    'success' => true,
                    'code'    => 200,
                    'message' => 'Products Search.',
                    'data'    => $products
                ]);
        } catch (\Exception $e) {
            return response()
                ->json([
                    'success' => false,
                    'code'    => $e->getCode(),
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function getProductDetail(Request $request, $product_id)
    {
        try {
            $product = $this->products_repository->getProductDetail($product_id);
            return response()
                ->json([
                    'success' => true,
                    'code'    => 200,
                    'message' => 'Product Detail.',
                    'data'    => $product
                ]);
        } catch (\Exception $e) {
            return response()
                ->json([
                    'success' => false,
                    'code'    => $e->getCode(),
                    'message' => $e->getMessage()
                ]);
        }
    }
}

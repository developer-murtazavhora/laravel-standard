<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\API\CategoriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    protected $categories_repository;

    public function __construct(CategoriesRepository $categories_repository)
    {
        $this->categories_repository = $categories_repository;
    }

    public function getCategories(Request $request)
    {
        try {
            $categories = $this->categories_repository->getCategories();
            return response()
                ->json([
                    'success' => true,
                    'code'    => 200,
                    'message' => 'Categories.',
                    'data'    => $categories
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

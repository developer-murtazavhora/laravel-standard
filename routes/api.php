<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UsersController@login');
Route::post('register', 'API\UsersController@register');

Route::get('categories', 'API\CategoriesController@getCategories');
Route::get('products/category/{category_id?}', 'API\ProductsController@getProductsByCategory');
Route::get('products/search/{keyword?}', 'API\ProductsController@getProductByKeyword');
Route::get('products/{product_id?}', 'API\ProductsController@getProductDetail');

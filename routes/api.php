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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/featured-product', [
    'uses' => 'App\Http\Controllers\APIController@getFeaturedProduct',
    'as' => 'featured-product'
]);

// API Featured Product
// http://localhost:8081/admin-three/public/api/featured-product

Route::get('/best-look-product', [
    'uses' => 'App\Http\Controllers\APIController@bestLookProduct',
    'as' => 'best-look-product'
]);

// API BestLook Product
// http://localhost:8081/admin-three/public/api/best-look-product

Route::get('/get-all-category', [
    'uses' => 'App\Http\Controllers\APIController@getAllCategory',
    'as' => 'get-all-category'
]);

// API Get All Category
// http://localhost:8081/admin-three/public/api/get-all-category

Route::get('/category-product/{id}', [
    'uses' => 'App\Http\Controllers\APIController@Category',
    'as' => 'category-product'
]);

// API Get Category Products
// http://localhost:8081/admin-three/public/api/category-product/{id}

Route::get('/sub-category-product/{id}', [
    'uses' => 'App\Http\Controllers\APIController@subCategoryProduct',
    'as' => 'sub-category-product'
]);

// API Get Sub Category Products
// http://localhost:8081/admin-three/public/api/sub-category-product/{id}


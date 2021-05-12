<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


Route::get('/', [
    'uses' => 'App\Http\Controllers\AdminLoginController@index',
    'as'   => '/',
]);


/* ================================ Start Dashboard Route ===================== */


Route::get('/dashboard', [
    'uses'       => 'App\Http\Controllers\AdminDashboardController@index',
    'as'         => 'dashboard',
    'middleware' => ['auth:sanctum', 'verified']
]);


/* ================================ End Dashboard Route ===================== */


/* ================================ Start Category Route ===================== */


Route::get('/manage-category', [
    'uses' => 'App\Http\Controllers\CategoryController@index',
    'as' => 'manage-category'
]);


Route::post('/new-category', [
    'uses' => 'App\Http\Controllers\CategoryController@create',
    'as' => 'new-category'
]);

Route::get('/update-category-status/{id}', [
    'uses' => 'App\Http\Controllers\CategoryController@updateStatus',
    'as' => 'update-category-status'
]);

Route::get('/edit-category/{id}', [
    'uses' => 'App\Http\Controllers\CategoryController@edit',
    'as' => 'edit-category'
]);

Route::post('/update-category', [
    'uses' => 'App\Http\Controllers\CategoryController@update',
    'as' => 'update-category'
]);

Route::get('/delete-category/{id}', [
    'uses' => 'App\Http\Controllers\CategoryController@delete',
    'as' => 'delete-category'
]);


/* ================================ End Category Route ===================== */


/* ================================ Start Sub Category Route ===================== */


Route::get('/manage-sub-category', [
    'uses' => 'App\Http\Controllers\SubCategoryController@index',
    'as' => 'manage-sub-category'
]);


Route::post('/new-sub-category', [
    'uses' => 'App\Http\Controllers\SubCategoryController@create',
    'as' => 'new-sub-category'
]);

Route::get('/update-sub-category-status/{id}', [
    'uses' => 'App\Http\Controllers\SubCategoryController@updateStatus',
    'as' => 'update-sub-category-status'
]);

Route::get('/edit-sub-category/{id}', [
    'uses' => 'App\Http\Controllers\SubCategoryController@edit',
    'as' => 'edit-sub-category'
]);

Route::post('/update-sub-category', [
    'uses' => 'App\Http\Controllers\SubCategoryController@update',
    'as' => 'update-sub-category'
]);

Route::get('/delete-sub-category/{id}', [
    'uses' => 'App\Http\Controllers\SubCategoryController@delete',
    'as' => 'delete-sub-category'
]);


/* ================================ End Sub Category Route ===================== */


/* ================================ Start Brand Route ===================== */


Route::get('/manage-brand', [
    'uses' => 'App\Http\Controllers\BrandController@index',
    'as' => 'manage-brand'
]);

Route::post('/new-brand', [
    'uses' => 'App\Http\Controllers\BrandController@create',
    'as' => 'new-brand'
]);

Route::get('/update-brand-status/{id}', [
    'uses' => 'App\Http\Controllers\BrandController@updateStatus',
    'as' => 'update-brand-status'
]);

Route::get('/edit-brand/{id}', [
    'uses' => 'App\Http\Controllers\BrandController@edit',
    'as' => 'edit-brand'
]);

Route::post('/update-brand', [
    'uses' => 'App\Http\Controllers\BrandController@update',
    'as' => 'update-brand'
]);

Route::get('/delete-brand/{id}', [
    'uses' => 'App\Http\Controllers\BrandController@delete',
    'as' => 'delete-brand'
]);


/* ================================ End Brand Route ===================== */


/* ================================ Start Unit Route ===================== */


Route::get('/manage-unit', [
    'uses' => 'App\Http\Controllers\UnitController@index',
    'as' => 'manage-unit'
]);


Route::post('/new-unit', [
    'uses' => 'App\Http\Controllers\UnitController@create',
    'as' => 'new-unit'
]);

Route::get('/update-unit-status/{id}', [
    'uses' => 'App\Http\Controllers\UnitController@updateStatus',
    'as' => 'update-unit-status'
]);

Route::get('/edit-unit/{id}', [
    'uses' => 'App\Http\Controllers\UnitController@edit',
    'as' => 'edit-unit'
]);

Route::post('/update-unit', [
    'uses' => 'App\Http\Controllers\UnitController@update',
    'as' => 'update-unit'
]);

Route::get('/delete-unit/{id}', [
    'uses' => 'App\Http\Controllers\UnitController@delete',
    'as' => 'delete-unit'
]);


/* ================================ End Unit Route ===================== */

/* ================================ Start Color Route ===================== */


Route::get('/manage-color', [
    'uses' => 'App\Http\Controllers\ColorController@index',
    'as' => 'manage-color'
]);


Route::post('/new-color', [
    'uses' => 'App\Http\Controllers\ColorController@create',
    'as' => 'new-color'
]);

Route::get('/update-color-status/{id}', [
    'uses' => 'App\Http\Controllers\ColorController@updateStatus',
    'as' => 'update-color-status'
]);

Route::get('/edit-color/{id}', [
    'uses' => 'App\Http\Controllers\ColorController@edit',
    'as' => 'edit-color'
]);

Route::post('/update-color', [
    'uses' => 'App\Http\Controllers\ColorController@update',
    'as' => 'update-color'
]);

Route::get('/delete-color/{id}', [
    'uses' => 'App\Http\Controllers\ColorController@delete',
    'as' => 'delete-color'
]);


/* ================================ End Color Route ===================== */


/* ================================ Start Size Route ===================== */


Route::get('/manage-size', [
    'uses' => 'App\Http\Controllers\SizeController@index',
    'as' => 'manage-size'
]);


Route::post('/new-size', [
    'uses' => 'App\Http\Controllers\SizeController@create',
    'as' => 'new-size'
]);

Route::get('/update-size-status/{id}', [
    'uses' => 'App\Http\Controllers\SizeController@updateStatus',
    'as' => 'update-size-status'
]);

Route::get('/edit-size/{id}', [
    'uses' => 'App\Http\Controllers\SizeController@edit',
    'as' => 'edit-size'
]);

Route::post('/update-size', [
    'uses' => 'App\Http\Controllers\SizeController@update',
    'as' => 'update-size'
]);

Route::get('/delete-size/{id}', [
    'uses' => 'App\Http\Controllers\SizeController@delete',
    'as' => 'delete-size'
]);


/* ================================ End Size Route ===================== */


/* ================================ Start Product Route ===================== */

Route::get('/add-prouct', [
    'uses' => 'App\Http\Controllers\ProductController@index',
    'as' => 'add-prouct'
]);

Route::get('/get-sub-category-info-by-category-id', [
    'uses' => 'App\Http\Controllers\ProductController@subCategoryByCategory',
    'as' => 'get-sub-category-info-by-category-id'
]);

Route::post('/new-product', [
    'uses' => 'App\Http\Controllers\ProductController@create',
    'as' => 'new-product'
]);

Route::get('/manage-prouct', [
    'uses' => 'App\Http\Controllers\ProductController@manage',
    'as' => 'manage-prouct'
]);

Route::get('/view-product-detail/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@detail',
    'as' => 'view-product-detail'
]);

Route::get('/update-product-status/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@updateProductStatus',
    'as' => 'update-product-status'
]);

Route::get('/edit-product/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@edit',
    'as' => 'edit-product'
]);
Route::post('/update-product', [
    'uses' => 'App\Http\Controllers\ProductController@update',
    'as' => 'update-product'
]);


Route::get('/delete-product/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@delete',
    'as' => 'delete-product'
]);

/* ================================ End Product Route ===================== */

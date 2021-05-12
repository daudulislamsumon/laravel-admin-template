<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubImage;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getFeaturedProduct() {
        $products = Product::orderBy('id', 'desc')->take(10)->get();
        $result = [];
        foreach ($products as $key => $product) {
            $subImage = SubImage::where('product_id', $product->id)->get()->first();
            $result[$key]['id']     =   $product->id;
            $result[$key]['name']   =   $product->name;
            $result[$key]['image']  =   asset($product->image);
            $result[$key]['image1'] =   asset($subImage->image);
            $result[$key]['price']  =   $product->discount_price;

        }
        return json_encode($result);
    }

    public function bestLookProduct() {
        $popularProduct = [];
        $pProducts = Product::where('status', 1)->orderBy('popular_count', 'desc')->take(8)->get(['id', 'name', 'image', 'discount_price']);
        foreach ($pProducts as $key => $pProduct) {
            $popularProduct[$key]['id']     =   $pProduct->id;
            $popularProduct[$key]['name']   =   $pProduct->name;
            $popularProduct[$key]['image']  =   asset($pProduct->image);
            $popularProduct[$key]['image1'] =   asset(SubImage::where('product_id', $pProduct->id)->first()->image);
            $popularProduct[$key]['price']  =   $pProduct->discount_price;
        }

        $bestSellerProduct = [];
        $bProducts = Product::where('status', 1)->orderBy('best_seller_count', 'desc')->take(8)->get(['id', 'name', 'image', 'discount_price']);
        foreach ($bProducts as $key => $bProduct) {
            $bestSellerProduct[$key]['id']      =   $bProduct->id;
            $bestSellerProduct[$key]['name']    =   $bProduct->name;
            $bestSellerProduct[$key]['image']   =   asset($bProduct->image);
            $bestSellerProduct[$key]['image1']  =   asset(SubImage::where('product_id', $bProduct->id)->first()->image);
            $bestSellerProduct[$key]['price']   =   $bProduct->discount_price;
        }

        $specialProduct = [];
        $sProducts = Product::where(['status' => 1, 'special_status' => 1])->orderBy('id', 'desc')->take(8)->get(['id', 'name', 'image', 'discount_price']);
        foreach ($sProducts as $key => $sProduct) {
            $specialProduct[$key]['id']     =   $sProduct->id;
            $specialProduct[$key]['name']   =   $sProduct->name;
            $specialProduct[$key]['image']  =   $sProduct->image;
            $specialProduct[$key]['image1'] =   asset(SubImage::where('product_id', $sProduct->id)->first()->image);
            $specialProduct[$key]['price']  =   $sProduct->discount_price;
        }

        $newProduct = [];
        $nProducts = Product::where('status', 1)->orderBy('id', 'desc')->take(8)->get(['id', 'name', 'image', 'discount_price']);
        foreach ($nProducts as $key => $nProduct) {
            $newProduct[$key]['id']     =   $nProduct->id;
            $newProduct[$key]['name']   =   $nProduct->name;
            $newProduct[$key]['image']  =   $nProduct->image;
            $newProduct[$key]['image1'] =   asset(SubImage::where('product_id', $nProduct->id)->first()->image);
            $newProduct[$key]['price']  =   $nProduct->discount_price;
        }
        $result = [
            0 => [
                'name' => 'Popular Product',
                'products' => $popularProduct
            ],
            1 => [
                'name' => 'Best seller Product',
                'products' =>  $bestSellerProduct
            ],
            2 => [
                'name' => 'Special Product',
                'products' => $specialProduct
            ],
            3 => [
                'name' => 'New Product',
                'products' => $newProduct
            ]
        ];

        return json_encode($result);
    }

    public function getAllCategory() {
        $categories = Category::all();
        $result = [];
        foreach ($categories as $key => $category) {
            $temp = [];
            $subCategories = SubCategory::where('category_id', $category->id)->get();
            foreach ($subCategories as $key1 => $subCategory) {
                $temp[$key1]['id']         =   $subCategory->id;
                $temp[$key1]['name']       =   $subCategory->name;
            }
            $result[$key]['id']            =   $category->id;
            $result[$key]['name']          =   $category->name;
            $result[$key]['sub_category']  =   $temp;
        }
        return json_encode($result);
    }

    public function Category($id) {
        $products = Product::where('category_id', $id)->orderBy('id', 'desc')->get();
        $result = [];
        foreach ($products as $key => $product) {
            $result[$key]['id']     =   $product->id;
            $result[$key]['name']   =   $product->name;
            $result[$key]['image']  =   asset($product->image);
            $result[$key]['image1'] =   asset(SubImage::where('product_id', $product->id)->first()->image);
            $result[$key]['price']  =   $product->discount_price;
        }
        return json_encode($result);
    }

    public function subCategoryProduct($id) {
        $products = Product::where('sub_category_id', $id)->orderBy('id', 'desc')->get();
        $result = [];
        foreach ($products as $key => $product) {
            $result[$key]['id']     =   $product->id;
            $result[$key]['name']   =   $product->name;
            $result[$key]['image']  =   asset($product->image);
            $result[$key]['image1'] =   asset(SubImage::where('product_id', $product->id)->first()->image);
            $result[$key]['price']  =   $product->discount_price;
        }
        return json_encode($result);
    }

}

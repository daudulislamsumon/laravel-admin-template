<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubImage;
use App\Models\ProductSize;
use App\Models\SubCategory;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $categories     = Category::all();
        $subCategories  = SubCategory::all();
        $brands         = Brand::all();
        $units          = Unit::all();
        $colors         = Color::all();
        $sizes          = Size::all();

        return view('product.add', [
            'categories'    => $categories,
            'subCategories' => $subCategories,
            'brands'        => $brands,
            'units'         => $units,
            'colors'        => $colors,
            'sizes'         => $sizes
        ]);
    }

    public function subCategoryByCategory() {
        $categoryId = $_GET['categoryId'];
        $subCategories = SubCategory::where('category_id', $categoryId)->get();
        return json_encode($subCategories);
    }

    private function uploadImage($image) {
        $type = $image->getClientOriginalExtension();
        $imageName = rand(1, 100).'_'.time().'.'.$type;
        $directory = 'product-image/';
        $image->move($directory, $imageName);
        return $directory.$imageName;
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:products',
            'code' => 'required|unique:products',
        ]);
        $product = new Product();
        $product->category_id       =   $request->category_id;
        $product->sub_category_id   =   $request->sub_category_id;
        $product->brand_id          =   $request->brand_id;
        $product->unit_id           =   $request->unit_id;
        $product->name              =   $request->name;
        $product->code              =   $request->code;
        $product->main_price        =   $request->main_price;
        $product->discount_price    =   $request->discount_price;
        $product->short_description =   $request->short_description;
        $product->long_description  =   $request->long_description;
        $product->short_description =   $request->short_description;
        $product->image             =   $this->uploadImage($request->file('image'));
        $product->status            =   $request->status;
        $product->save();

        foreach ($request->color as $color) {
            $productColor = new ProductColor();
            $productColor->product_id = $product->id;
            $productColor->color_id = $color;
            $productColor->save();
        }
        foreach ($request->size as $size) {
            $productSize = new ProductSize();
            $productSize->product_id = $product->id;
            $productSize->size_id = $size;
            $productSize->save();
        }

        $images = $request->file('sub_image');
        foreach ($images as $image) {
            $subImage = new SubImage();
            $subImage->product_id = $product->id;
            $subImage->image = $this->uploadImage($image);
            $subImage->save();
        }
        return redirect()->back()->with('message', 'Product info created successfully');
    }

    public function manage() {
        $products = Product::orderBy('id', 'desc')->get(['id', 'category_id', 'sub_category_id', 'name', 'code', 'image', 'status']);
        return view('product.manage', ['products' => $products]);
    }

    public function detail($id) {
        $product = Product::find($id);
        return view('product.detail', [
            'product' => $product,
            'colors' => ProductColor::where('product_id', $product->id)->get(),
            'sizes' => ProductSize::where('product_id', $product->id)->get(),
            'sub_images' => SubImage::where('product_id', $product->id)->get()
        ]);
    }

    public function updateProductStatus($id) {
        $product = Product::find($id);
        if ($product->status == 1) {
            $product->status = 0;
            $message = 'Product status Unpublished successfully';
        } else {
            $product->status = 1;
            $message = 'Product status Published successfully';
        }

        $product->save();
        return redirect()->back()->with('message', $message);
    }

    public function edit($id) {
        $product = Product::find($id);
        return view('product.edit', [
            'product'           =>  $product,
            'categories'        =>  Category::all(),
            'subCategories'     =>  SubCategory::all(),
            'brands'            =>  Brand::all(),
            'units'             =>  Unit::all(),
            'colors'            =>  Color::all(),
            'sizes'             =>  Size::all(),
            'product_colors'    =>  ProductColor::where('product_id', $product->id)->get(),
            'product_sizes'     =>  ProductSize::where('product_id', $product->id)->get(),
            'sub_images'        =>  SubImage::where('product_id', $product->id)->get()
        ]);
    }

    public function update(Request $request) {
        $product = Product::find($request->id);
        if ($image = $request->file('image')) {
            if (file_exists($product->image)) {
                unlink($product->image);
            }
            $imgURL = $this->uploadImage($image);
        } else {
            $imgURL = $product->image;
        }

        $product->category_id       =   $request->category_id;
        $product->sub_category_id   =   $request->sub_category_id;
        $product->brand_id          =   $request->brand_id;
        $product->unit_id           =   $request->unit_id;
        $product->name              =   $request->name;
        $product->code              =   $request->code;
        $product->main_price        =   $request->main_price;
        $product->discount_price    =   $request->discount_price;
        $product->short_description =   $request->short_description;
        $product->long_description  =   $request->long_description;
        $product->short_description =   $request->short_description;
        $product->image             =   $imgURL;
        $product->status            =   $request->status;
        $product->save();

        $productColors = ProductColor::where('product_id', $product->id)->get();
        foreach ($productColors as $productColor) {
            $productColor->delete();
        }
        foreach ($request->color as $color) {
            $productColor = new ProductColor();
            $productColor->product_id = $product->id;
            $productColor->color_id = $color;
            $productColor->save();
        }
        $productSizes = ProductSize::where('size_id', $product->id)->get();
        foreach ($productSizes as $productSize) {
            $productSize->delete();
        }
        foreach ($request->size as $size) {
            $productSize = new ProductSize();
            $productSize->product_id = $product->id;
            $productSize->size_id = $size;
            $productSize->save();
        }

        if ($images = $request->file('sub_image')) {
            $subImages = SubImage::where('product_id', $product->id)->get();
            foreach ($subImages as $subImage) {
                if (file_exists($subImage->image)) {
                    unlink($subImage->image);
                }
                $subImage->delete();
            }

            foreach ($images as $image) {
                $subImage = new SubImage();
                $subImage->product_id = $product->id;
                $subImage->image = $this->uploadImage($image);
                $subImage->save();
            }
        }
        return redirect('manage-prouct')->with('message', 'Product Info Update Successfully');
    }

    public function delete($id) {
       $product = Product::find($id);
       if (file_exists($product->image)) {
           unlink($product->image);
       }

       $subImages = SubImage::where('product_id', $id)->get();
       foreach ($subImages as $subImage) {
           if (file_exists($subImage->image)) {
               unlink($subImage->image);
           }
           $subImage->delete();
       }
       $productColors = ProductColor::where('product_id', $product->id)->get();
        foreach ($productColors as $productColor) {
            $productColor->delete();
        }

        $productSizes = ProductSize::where('size_id', $product->id)->get();
        foreach ($productSizes as $productSize) {
            $productSize->delete();
        }

       $product->delete();
    }

}

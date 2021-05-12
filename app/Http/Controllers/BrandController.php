<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index() {
        return view('brand.add', ['brands' => Brand::all()]);
    }

    public function create(Request $request) {
        $image = $request->file('image');
        if ($image) {

            $type = $image->getClientOriginalExtension();
            $imageName = time().'.'.$type;
            $directory = 'brand-images/';
            $image->move($directory, $imageName);
            $imageURL = $directory.$imageName;

        } else {

            $imageURL = 'assets/images/dummy.jpg';
        }

        $brand = new Brand();

        $brand->name        = $request->name;
        $brand->description = $request->description;
        $brand->image       = $imageURL;
        $brand->status      = $request->status;
        $brand->save();
        return redirect()->back()->with('message', 'Brand info created successfully');

    }

    public function updateStatus($id) {
        $brand = Brand::find($id);
        if ($brand->status == 1) {
            $brand->status = 0;
            $message = 'Brand Status Unpublished Successfully.';
        } else {
            $brand->status = 1;
            $message = 'Brand Status Published Successfully.';
        }
        $brand->save();

        return redirect()->back()->with('message', $message);
    }

    public function edit($id) {
        $brands = Brand::all();
        $brand = Brand::find($id);
        return view('brand.edit', [

            'brands' => $brands,
            'brand' => $brand
        ]);
    }

    public function update(Request $request) {
        $brand = Brand::find($request->id);
        $image = $request->file('image');
        if ($image) {
            $type = $image->getClientOriginalExtension();
            $imageName = time().'.'.$type;
            $directory = 'category-images/';
            $image->move($directory, $imageName);
            $imageURL = $directory.$imageName;

        } else {

            $imageURL = $brand->image;
        }

        $brand->name         = $request->name;
        $brand->description  = $request->description;
        $brand->image        = $imageURL;
        $brand->status       = $request->status;
        $brand->save();
        return redirect('manage-brand')->with('message', 'Brand info updated successfully');
    }

    public function delete($id) {
        $products = Product::where('brand_id', $id)->get();
        if (count($products) > 0) {
            return redirect()->back()->with('message', 'Sorry this Brand has some products. So you can not delete this category');
        }
        $brand = Brand::find($id);
        if (file_exists($brand->image)) {
            unlink($brand->image);
        }
        $brand->delete();
        return redirect('/manage-brand')->with('message', 'Brand info deleted successfully');
    }
}

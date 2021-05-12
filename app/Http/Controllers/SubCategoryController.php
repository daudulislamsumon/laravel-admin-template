<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index() {
        return view('sub-category.add', [
            'sub_categories' => SubCategory::all(),
            'categories' => Category::all()
        ]);
    }

    public function create(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:sub_categories|max:100|regex:/(^([a-zA-z ]+)(\+)?$)/u'
        ]);

        $image = $request->file('image');
        if ($image) {
            $type = $image->getClientOriginalExtension();
            $imageName = time().'.'.$type;
            $directory = 'sub-category-images/';
            $image->move($directory, $imageName);
            $imageURL = $directory.$imageName;

        } else {

            $imageURL = 'assets/images/dummy.jpg';
        }

        $subCategory = new SubCategory();
        $subCategory->category_id  =    $request->category_id;
        $subCategory->name         =    $request->name;
        $subCategory->description  =    $request->description;
        $subCategory->image        =    $imageURL;
        $subCategory->status       =    $request->status;
        $subCategory->save();
        return redirect()->back()->with('message', 'Sub Category info created successfully');

    }

    public function updateStatus($id) {
        $subcategory = SubCategory::find($id);
        if ($subcategory->status == 1) {
            $subcategory->status = 0;
            $message = 'Sub Category Status Unpublished Successfully.';
        } else {
            $subcategory->status = 1;
            $message = 'Sub Category Status Published Successfully.';
        }
        $subcategory->save();

        return redirect()->back()->with('message', $message);
    }

    public function edit($id) {
        $subCategories = SubCategory::all();
        $subCategory = SubCategory::find($id);
        $categories = Category::all();

        return view('sub-category.edit', [
            'sub_categories' => $subCategories,
            'sub_category' => $subCategory,
            'categories' =>$categories
        ]);
    }

    public function update(Request $request) {
        $subCategory = SubCategory::find($request->id);

        $image = $request->file('image');
        if ($image) {

            $type = $image->getClientOriginalExtension();
            $imageName = time().'.'.$type;
            $directory = 'sub-category-images/';
            $image->move($directory, $imageName);
            $imageURL = $directory.$imageName;

        } else {

            $imageURL = $subCategory->image;
        }

        $subCategory->name         =    $request->name;
        $subCategory->description  =    $request->description;
        $subCategory->image        =    $imageURL;
        $subCategory->status       =    $request->status;
        $subCategory->save();
        return redirect('manage-sub-category')->with('message', 'Sub Category info updated successfully');
    }

    public function delete($id) {
        $products = Product::where('sub_category_id', $id)->get();
        if (count($products) > 0) {
            return redirect()->back()->with('message', 'Sorry this Sub category has some products. So you can not delete this category');
        }
        $subCategory = SubCategory::find($id);
        if (file_exists($subCategory->image)) {
            unlink($subCategory->image);
        }
        $subCategory->delete();
        return redirect('manage-sub-category')->with('message', 'Sub Category info deleted successfully');
    }
}

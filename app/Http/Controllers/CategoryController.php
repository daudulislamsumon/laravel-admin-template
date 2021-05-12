<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('category.add', ['categories' => Category::all()]);
    }

    public function create(Request $request) {
        $image = $request->file('image');
        if ($image) {

            $type = $image->getClientOriginalExtension();
            $imageName = time().'.'.$type;
            $directory = 'category-images/';
            $image->move($directory, $imageName);
            $imageURL = $directory.$imageName;

        } else {

            $imageURL = 'assets/images/dummy.jpg';
        }

        $category = new Category();

        $category->name         = $request->name;
        $category->description  = $request->description;
        $category->image        = $imageURL;
        $category->status       = $request->status;
        $category->save();
        return redirect()->back()->with('message', 'Category info created successfully');

    }

    public function updateStatus($id) {

        $category = Category::find($id);
        if ($category->status == 1) {
            $category->status = 0;
            $message = 'Category Status Unpublished Successfully.';
        } else {
            $category->status = 1;
            $message = 'Category Status Published Successfully.';
        }
        $category->save();

        return redirect()->back()->with('message', $message);
    }

    public function edit($id) {
        $categories = Category::all();
        $category = Category::find($id);

        return view('category.edit', [
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function update(Request $request) {
        $category = Category::find($request->id);
        $image = $request->file('image');
        if ($image) {
            $type = $image->getClientOriginalExtension();
            $imageName = time().'.'.$type;
            $directory = 'category-images/';
            $image->move($directory, $imageName);
            $imageURL = $directory.$imageName;

        } else {

            $imageURL = $category->image;
        }

        $category->name         = $request->name;
        $category->description  = $request->description;
        $category->image        = $imageURL;
        $category->status       = $request->status;
        $category->save();
        return redirect('manage-category')->with('message', 'Category info updated successfully');
    }

    public function delete($id) {
        $products = Product::where('category_id', $id)->get();
        if (count($products) > 0) {
            return redirect()->back()->with('message', 'Sorry this category has some products. So you can not delete this category');
        }
        $category = Category::find($id);
        $subCategories = SubCategory::where('category_id', $category->id)->get();
        if (count($subCategories) > 0) {
            foreach ($subCategories as $subCategory) {
                if (file_exists($subCategory->image)) {
                    unlink($subCategory->image);
                }
                $subCategory->delete();
            }

        }
        if (file_exists($category->image)) {
            unlink($category->image);
        }

        $category->delete();
        return redirect('/manage-category')->with('message', 'Category info deleted successfully');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index() {
        return view('size.add', ['sizes' => Size::all()]);
    }

    public function create(Request $request) {
        $size = new Size();
        $size->name        = $request->name;
        $size->description = $request->description;
        $size->code       = $request->code;
        $size->status      = $request->status;
        $size->save();
        return redirect()->back()->with('message', 'Color info created successfully');

    }

    public function updateStatus($id) {
        $size = Size::find($id);
        if ($size->status == 1) {
            $size->status = 0;
            $message = 'Color Status Unpublished Successfully.';
        } else {
            $size->status = 1;
            $message = 'Color Status Published Successfully.';
        }
        $size->save();
        return redirect()->back()->with('message', $message);
    }

    public function edit($id) {
        $sizes = Size::all();
        $size = Size::find($id);
        return view('size.edit', [
            'sizes' => $sizes,
            'size' => $size
        ]);
    }

    public function update(Request $request) {
        $size = Size::find($request->id);
        $size->name         = $request->name;
        $size->description  = $request->description;
        $size->code         = $request->code;
        $size->status       = $request->status;
        $size->save();
        return redirect('manage-size')->with('message', 'Color info updated successfully');
    }

    public function delete($id) {
        $productSizes = ProductSize::where('size_id', $id)->get();
        if (count($productSizes) > 0) {
            return redirect()->back()->with('message', 'Sorry this Size has some products. So you can not delete this category');
        }
        $size = Size::find($id);
        $size->delete();
        return redirect('manage-size')->with('message', 'Size info deleted successfully');
    }
}

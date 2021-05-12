<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index() {
        return view('color.add', ['colors' => Color::all()]);
    }

    public function create(Request $request) {
        $color = new Color();
        $color->name        = $request->name;
        $color->description = $request->description;
        $color->code       = $request->code;
        $color->status      = $request->status;
        $color->save();
        return redirect()->back()->with('message', 'Color info created successfully');

    }

    public function updateStatus($id) {
        $color = Color::find($id);
        if ($color->status == 1) {
            $color->status = 0;
            $message = 'Color Status Unpublished Successfully.';
        } else {
            $color->status = 1;
            $message = 'Color Status Published Successfully.';
        }
        $color->save();
        return redirect()->back()->with('message', $message);
    }

    public function edit($id) {
        $colors = Color::all();
        $color = Color::find($id);
        return view('color.edit', [

            'colors' => $colors,
            'color' => $color
        ]);
    }

    public function update(Request $request) {
        $color = Color::find($request->id);
        $color->name         = $request->name;
        $color->description  = $request->description;
        $color->code       = $request->code;
        $color->status       = $request->status;
        $color->save();
        return redirect('manage-color')->with('message', 'Color info updated successfully');
    }

    public function delete($id) {
        $productColors = ProductColor::where('color_id', $id)->get();
        if (count($productColors) > 0) {
            return redirect()->back()->with('message', 'Sorry this Color has some products. So you can not delete this category');
        }
        $color = Color::find($id);
        $color->delete();
        return redirect('manage-color')->with('message', 'Color info deleted successfully');
    }
}

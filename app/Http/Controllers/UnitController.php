<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Product;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index() {
        return view('unit.add', ['units' => Unit::all()]);
    }

    public function create(Request $request) {
        $unit = new Unit();

        $unit->name        = $request->name;
        $unit->code        = $request->code;
        $unit->description = $request->description;
        $unit->status      = $request->status;
        $unit->save();
        return redirect()->back()->with('message', 'Unit info created successfully');

    }

    public function updateStatus($id) {

        $unit = Unit::find($id);
        if ($unit->status == 1) {
            $unit->status = 0;
            $message = 'Unit Status Unpublished Successfully.';
        } else {
            $unit->status = 1;
            $message = 'Unit Status Published Successfully.';
        }
        $unit->save();

        return redirect()->back()->with('message', $message);
    }

    public function edit($id) {

        $units = Unit::all();
        $unit = Unit::find($id);

        return view('unit.edit', [

            'units' => $units,
            'unit' => $unit
        ]);
    }

    public function update(Request $request) {

        $unit = Unit::find($request->id);
        $unit->name         = $request->name;
        $unit->code         = $request->code;
        $unit->description  = $request->description;
        $unit->status       = $request->status;
        $unit->save();
        return redirect('manage-unit')->with('message', 'Unit info updated successfully');
    }

    public function delete($id) {
        $products = Product::where('unit_id', $id)->get();
        if (count($products) > 0) {
            return redirect()->back()->with('message', 'Sorry this Unit has some products. So you can not delete this category');
        }
        $unit = Unit::find($id);
        $unit->delete();
        return redirect('/manage-unit')->with('message', 'Unit info deleted successfully');
    }
}

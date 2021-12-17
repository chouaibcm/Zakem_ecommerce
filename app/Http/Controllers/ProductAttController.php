<?php

namespace App\Http\Controllers;

use App\ProductAtt;
use App\Product;
use Illuminate\Http\Request;

class ProductAttController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:update_products'])->only('edit');
    }
    public function index()
    {
        $main_sidebar=3;
        $productAtts = ProductAtt::all();
        return view('backend.products.productAtt.index',compact('productAtts','main_sidebar'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        $ProductAtt = new ProductAtt();
        $ProductAtt->name = $request->name;
        $ProductAtt->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('productsatts.index');
    }

    public function show(Request $request)
    {
        //
    }

    public function edit(Request $request)
    {
    }

    public function update(Request $request)
    {   
        $this->validate($request,[
            'name'=>'required',
        ]);     
        $productAtt = ProductAtt::findOrFail($request->id);
        $productAtt->update([
            $productAtt->name = $request->name,
        ]);        
        toastr()->success(trans('messages.Update'));
        return redirect()->route('productsatts.index');
    }

    public function destroy(Request $request)
    {
        $productAtt = ProductAtt::findOrFail($request->id);
        $productAtt->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('productsatts.index');
    }
}

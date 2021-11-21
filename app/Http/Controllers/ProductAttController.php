<?php

namespace App\Http\Controllers;

use App\ProductAtt;
use App\Product;
use Illuminate\Http\Request;

class ProductAttController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'sku'=>'required',
            'size'=>'required',
            'stock'=>'required|numeric'
        ]);
        $ProductAtt = new ProductAtt();
        $ProductAtt->product_id = $request->id;
        $ProductAtt->sku = $request->sku;
        $ProductAtt->size = $request->size;
        $ProductAtt->stock = $request->stock;
        $ProductAtt->save();
        toastr()->success(trans('messages.success'));
        return back();
    }

    public function show(Request $request)
    {
        //
    }

    public function edit(Request $request)
    {
        
        $main_sidebar=3;
        $product = Product::findOrFail($request->id);
        $productAtts = ProductAtt::where('product_id',$request->id)->get();
        return view('backend.products.productAtt.crud',compact('product','productAtts','main_sidebar'));
    }

    public function update(Request $request)
    {        
        $productAtt = ProductAtt::findOrFail($request->id);
        $productAtt->update([
            $productAtt->sku = $request->sku,
            $productAtt->size = $request->size,
            $productAtt->stock = $request->stock,
        ]);        
        toastr()->success(trans('messages.Update'));
        return back();
    }

    public function destroy(Request $request)
    {
        $productAtt = ProductAtt::findOrFail($request->id);
        $productAtt->delete();
        toastr()->success(trans('messages.Delete'));
        return back();
    }
}

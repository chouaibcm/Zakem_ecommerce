<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\ProductAtt;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $main_sidebar=3;        
        $cate_levels=Category::where('parent_id', '=', 0)->with('childs')->get();
        
        if($request->category_id==0){   // all categories         
            $products=Product::orderBy('id', 'DESC')->get();
        }else{// chooose category
            $products = Product::where('category_id','=',$request->category_id)->get();
        }
        return view('backend.products.index',compact('products','main_sidebar','cate_levels'));
    }

    public function create()
    {
        $main_sidebar=3;
        $categories=Category::all(); 
        $cate_levels=Category::where('parent_id',0)->get();
        return view('backend.products.create',compact('cate_levels','main_sidebar','categories'));
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'p_code' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        if($request->image){            
            Image::make($request->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_img/' . $request->image->hashName()));
        }

        $product = new Product();
        
        $product->name = $request->name;
        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->p_code = $request->p_code;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = $request->status;
        if($request->image){ 
        $product->image = $request->image->hashName();}
        $product->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('products.index');
    }

    public function show(Request $request)
    {
        //
    }

    public function edit(Request $request)
    {
        $main_sidebar=3; 
        $product = Product::findOrFail($request->id);
        $cate_levels=Category::where('parent_id',0)->get();
        return view('backend.products.edit',compact('cate_levels','main_sidebar','product'));
    }

    public function update(Request $request)
    {
        $request->validate( [
            'name' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'p_code' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = Product::findOrFail($request->id);
        if ($request->image) {
            if($product->image != 'default.png'){
                $path=public_path('uploads/product_img/' . $product->image);
                    unlink($path);  
            }
        if($request->image){            
            Image::make($request->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_img/' . $request->image->hashName()));
        }
        }

        $product->update([
            $product->name = $request->name,
            $product->title = $request->title,
            $product->category_id = $request->category_id,
            $product->p_code = $request->p_code,
            $product->price = $request->price,
            $product->description = $request->description,
            $product->status = $request->status,
        ]);
        if($request->image){ 
            $product->update([
            $product->image = $request->image->hashName(),
            ]);    
         }

        toastr()->success(trans('messages.Update'));
        return redirect()->route('products.index');
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if($product->image != 'default.png'){
            $path=public_path('uploads/product_img/' . $product->image);
                unlink($path);  
        }
        $product->delete();         
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('products.index');
    }
}

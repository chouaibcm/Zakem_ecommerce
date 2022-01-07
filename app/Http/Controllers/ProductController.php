<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\ProductImg;
use App\ProductAtt;
use App\AttributeValue;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_products'])->only('create');
        $this->middleware(['permission:read_products'])->only('index');
        $this->middleware(['permission:update_products'])->only('edit');
    }
    public function index(Request $request)
    {
        $main_sidebar=3;        
        $categories=Category::all();
        
        if($request->category_id==0){   // all categories         
            $products=Product::orderBy('id', 'DESC')->get();
        }else{// chooose category
            $products = Product::where('category_id','=',$request->category_id)->get();
        }
        return view('backend.products.index',compact('products','main_sidebar','categories'));
    }

    public function create()
    {
        $main_sidebar=3;
        $categories=Category::all();
        $productAtts=ProductAtt::all();
        return view('backend.products.create',compact('main_sidebar','categories','productAtts'));
    }

    public function store(Request $request)
    {
        //products attributes array
        if($request->att_on){
        $p_atts = array_chunk($request->fields, 2);
        foreach($p_atts as $p_att){
            if($p_att[0]==null or $p_att[1]==0){
                $request->validate( [
                    'fields[]' => 'required',
                ]);
            }            
        }
        }
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
        $product->stock = $request->stock;
        //save image in db
        if($request->image){ 
        $product->image = $request->image->hashName();}
        $product->save();
        //save albume of pics
        if($request->albume){
            foreach($request->albume as $pic){
                Image::make($pic)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/product_img/' . $pic->getClientOriginalName()));
                $p_img=new ProductImg();
                $p_img->product_id = $product->id;
                $p_img->image =$pic->getClientOriginalName();
                $p_img->save();
            }   
        }
        if($request->att_on){
        foreach($p_atts as $p_att){
            $new_p_att = new AttributeValue(); 
            $new_p_att->value = $p_att[0]; 
            $new_p_att->product_att_id = $p_att[1];
            $new_p_att->product_id = $product->id;
            $new_p_att->save();           
        }
        }
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
        $categories=Category::all();
        $product = Product::findOrFail($request->id);
        $productAtts=ProductAtt::all();
        return view('backend.products.edit',compact('categories','main_sidebar','product','productAtts'));
    }

    public function update(Request $request)
    {
        if($request->fields2){
            $p_atts2 = array_chunk($request->fields2, 3);
            foreach($p_atts2 as $p_att2){
                if($p_att2[0]==null or $p_att2[1]==0){
                    $request->validate( [
                        'fields2[]' => 'required',
                    ]);
                }            
            }
            }
            if($request->att_on){
                $p_atts = array_chunk($request->fields, 2);
                foreach($p_atts as $p_att){
                    if($p_att[0]==null or $p_att[1]==0){
                        $request->validate( [
                            'fields[]' => 'required',
                        ]);
                    }            
                }
                }
        $request->validate( [
            'name' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'p_code' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = Product::findOrFail($request->id);
        if ($request->image){
            if($product->image != 'default.png'){
                $path=public_path('uploads/product_img/' . $product->image);
                    unlink($path);  
            }        
            Image::make($request->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_img/' . $request->image->hashName()));
            $product->update([
                $product->image = $request->image->hashName(),
                ]); 
        }
        //save albume of pics
        if($request->albume){
            foreach ($product->product_images as $image) {
                $path=public_path('uploads/product_img/' . $image->image);
                    unlink($path); 
                    $image->delete();
            }
            foreach($request->albume as $pic){
                Image::make($pic)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/product_img/' . $pic->getClientOriginalName()));
                $p_img=new ProductImg();
                $p_img->product_id = $product->id;
                $p_img->image =$pic->getClientOriginalName();
                $p_img->save();
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
            $product->stock = $request->stock,
        ]);
        //--------------------------update attribute value
        if($request->fields2){
            $p_atts2 = array_chunk($request->fields2, 3);
        foreach($product->attr_values as $att_v){
            $still_existe=0;
            foreach($p_atts2 as $p_att2){
                if($att_v->id == $p_att2[2]){
                    $still_existe=1;
                    $updt=AttributeValue::findOrFail($att_v->id);
                    $updt->update([
                        $updt->value = $p_att2[0],
                        $updt->product_att_id = $p_att2[1],
                    ]);
                }
            }
            if($still_existe==0){
                $updt=AttributeValue::findOrFail($att_v->id);
                $updt->delete();
            }
        }
        }
        //---------------------------------------------------
        //added new attribute value
        if($request->att_on){
            foreach($p_atts as $p_att){
                $new_p_att = new AttributeValue(); 
                $new_p_att->value = $p_att[0]; 
                $new_p_att->product_att_id = $p_att[1];
                $new_p_att->product_id = $product->id;
                $new_p_att->save();           
            }
            }// end of new attribute added

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
        foreach ($product->product_images as $image) {
            $path=public_path('uploads/product_img/' . $image->image);
                unlink($path); 
                $image->delete();
        }
        $product->delete();         
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('products.index');
    }
}

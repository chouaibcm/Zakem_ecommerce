<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_categories'])->only('index');
    }
    public function index()
    {
        $main_sidebar=2;
        //------------------------------
        $categories=Category::all();
        return view('backend.categories.index',compact('categories','main_sidebar'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name_ar' => 'required|max:255|unique:categories,name',
            'name_en' => 'required|max:255|unique:categories,name',
        ]);
        $category = new Category();
        
        $category->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        if ($request->status == 1) {            
            $category->status = $request->status;
        } else {            
            $category->status = 0;
        }        
        $category->save();

        toastr()->success(trans('messages.success'));
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $request->validate( [
            'name_ar' => 'required|max:255|unique:categories,name,'.$category->id,
            'name_en' => 'required|max:255|unique:categories,name,'.$category->id,
        ]);
        
        if ($request->status == 1) {          
            $test=1;
        } else {            
            $test = 0;
        }  
        $category->update([
            $category->Name = ['ar' => $request->name_ar, 'en' => $request->name_en],           
            $category->status = $test,       
          ]);
          toastr()->success(trans('messages.Update'));
        return redirect()->route('categories.index');
    }

    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $products = Product::where('category_id',$category->id)->get();
        if ($products->count()>0) {
            toastr()->error(trans('categories_trans.delete_category_Error'));
            return redirect()->route('categories.index');
        } else {
            $category->delete();         
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('categories.index');
        }
        
        
    }
}

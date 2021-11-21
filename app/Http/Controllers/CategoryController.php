<?php

namespace App\Http\Controllers;

use App\Category;
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
        //category level in add category
        $cate_levels=Category::where('parent_id',0)->get();
        // $cate_levels=['0'=>'Main Category']+$plucked->all();
        //------------------------------
        $categories=Category::all();
        return view('backend.categories.index',compact('categories','cate_levels','main_sidebar'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);
        $category = new Category();
        
        $category->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $category->parent_id = $request->parent_id;
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
        $request->validate( [
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);
        
        $category = Category::findOrFail($request->id);
        if ($request->status == 1) {          
            $test=1;
        } else {            
            $test = 0;
        }  
        $category->update([
            $category->Name = ['ar' => $request->name_ar, 'en' => $request->name_en],           
            $category->status = $test,      
            $category->parent_id = $request->parent_id,      
          ]);
          toastr()->success(trans('messages.Update'));
        return redirect()->route('categories.index');
    }

    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->delete();         
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('categories.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\FirstSlider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FirstSliderController extends Controller
{
    public function index()
    {
        $main_sidebar=8; 
        $sliders= FirstSlider::all();
        return view('backend.settings.firstslider.index',compact('main_sidebar','sliders'));
    }

    public function create()
    {
        $main_sidebar=8; 
        $sliders= FirstSlider::all();
        return view('backend.settings.firstslider.crud',compact('main_sidebar','sliders'));
    }

    public function store(Request $request)
    {
        
        if($request->image){            
            Image::make($request->image)->resize(null, 1280, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/carousel/' . $request->image->hashName()));
        }

        $slider = new FirstSlider();
        $slider->heading = ['en' => $request->heading_en, 'ar' => $request->heading_ar];
        $slider->description = ['en' => $request->description_en, 'ar' => $request->description_ar];
        $slider->position = $request->position;
        if($request->image){ 
            $slider->image = $request->image->hashName();
        }
        $slider->save();

        toastr()->success(trans('messages.success'));
        return redirect()->route('settings.create');
        
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update(Request $request)
    {
        $slider = FirstSlider::findOrFail($request->id);
        if ($request->image) {
            // lakan image li kanat 9bal mach default tna7iha 
            if($slider->image != 'default.png'){
                $path=public_path('uploads/carousel/' . $slider->image);
                    unlink($path);  
            }
                   // t7at image jdida
                   Image::make($request->image)->resize(null, 1280, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/carousel/' . $request->image->hashName()));
            // t7otha f base de donnees
            $slider->update([
                $slider->image = $request->image->hashName(),
                ]);         
        }

        $slider->update([
            $slider->heading = ['en' => $request->heading_en, 'ar' => $request->heading_ar],
            $slider->description = ['en' => $request->description_en, 'ar' => $request->description_ar],
            $slider->position = $request->position,
        ]);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('settings.create');
    }

    public function destroy(Request $request)
    {
        $slider = FirstSlider::findOrFail($request->id);
        if($slider->image != 'default.png'){
            $path=public_path('uploads/carousel/' . $slider->image);
                unlink($path);  
        }
        $slider->delete();         
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('settings.create');
    }
}

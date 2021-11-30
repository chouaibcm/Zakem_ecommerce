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
        $request->validate( [
            'heading_ar' => 'required',
            'heading_en' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
        ]);
        if($request->image){            
            Image::make($request->image)->save(public_path('uploads/carousel/' . $request->image->hashName()));
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
        //
    }

    public function destroy(Request $request)
    {
        //
    }
}

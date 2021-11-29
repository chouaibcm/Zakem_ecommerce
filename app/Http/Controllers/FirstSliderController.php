<?php

namespace App\Http\Controllers;

use App\FirstSlider;
use Illuminate\Http\Request;

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
        //
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

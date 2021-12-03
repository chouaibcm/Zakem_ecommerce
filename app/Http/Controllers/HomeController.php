<?php

namespace App\Http\Controllers;

use App\Product;
use App\Contactinf;
use App\FirstSlider;
use App\Socialmedia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $main_nav=1; 
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        $products=Product::where('status',1)
        ->orderBy('created_at','desc')
        ->take(8)
        ->get();
        $sliders= FirstSlider::all();
        return view('home',compact('main_nav','products','sliders','socialmedia','contactinf'));
    }
}

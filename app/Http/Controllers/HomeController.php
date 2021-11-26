<?php

namespace App\Http\Controllers;

use App\Product;
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
        $products=Product::where('status',1)
        ->orderBy('created_at','desc')
        ->take(8)
        ->get();
        return view('home',compact('main_nav','products'));
    }
}

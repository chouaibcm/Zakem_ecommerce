<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Cart;
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

    public function shop(Request $request)
    {
        if($request->category_id){
            $products=Product::where('status',1)
        ->where('category_id',$request->category_id)
        ->orderBy('created_at','desc')
        ->paginate(10);
        }else{
            $products=Product::where('status',1)
            ->orderBy('created_at','desc')
            ->paginate(10);
        }
        $main_nav=1; 
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        $categories=Category::where('status', 1)->where('parent_id',0)->get();
        
        return view('frontend.shop',compact('main_nav','products','categories','socialmedia','contactinf'));
    }

    public function product_detail(Product $product)
    {
        //frontend layout variable        
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        // end of frontend layout variable
        return view('frontend.product_detail',compact('product','socialmedia','contactinf'));
    }
}

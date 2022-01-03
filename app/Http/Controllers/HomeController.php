<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Review;
use App\Category;
use Cart;
use App\Contactinf;
use App\FirstSlider;
use App\Socialmedia;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $categories=Category::where('status', 1)->get();
        
        return view('frontend.shop',compact('main_nav','products','categories','socialmedia','contactinf'));
    }

    public function product_detail(Product $product)
    {
        //frontend layout variable        
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        $reviews=$product->reviews()->paginate(8);
        // end of frontend layout variable
        return view('frontend.product_detail',compact('product','socialmedia','contactinf','reviews'));
    }

    public function add_review(Request $request, Product $product)
    {
        //frontend layout variable        
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        // end of frontend layout variable
        return view('frontend.addreview',compact('product','socialmedia','contactinf'));
    }
    public function upload_review(Request $request, Product $product)
    {
        
        // end of frontend layout variable

        $review = new Review();
        $review->user_id = $request->user_id;
        $review->product_id = $product->id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();
        
        toastr()->success(trans('messages.success'));
        return redirect()->route('my_orders',$request->user_id);
    }

    public function my_profile(Request $request, User $user)
    {
        //frontend layout variable        
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        // end of frontend layout variable
        return view('frontend.my_profile',compact('user','socialmedia','contactinf'));
    }
    //update_profile
    public function update_profile(Request $request, User $user)
    {
        $request->validate( [
            'name' => 'required',
        ]);

        if ($request->image) {
            if($user->image != 'default.png'){
                $path=public_path('uploads/user_img/' . $user->image);
                    unlink($path);  
            }
        if($request->image){            
            Image::make($request->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_img/' . $request->image->hashName()));
        }
        }
        $user->update([
            $user->name = $request->name,
            $user->address= $request->address,
            $user->city= $request->city,
            $user->state= $request->state,
            $user->country= $request->country,
            $user->mobile= $request->mobile,
            $user->pincode= $request->pincode,
          ]);
          if($request->image){ 
            $user->update([
            $user->image = $request->image->hashName(),
            ]);    
         }
        toastr()->success(trans('messages.Update'));
        return redirect()->back();
    }

}

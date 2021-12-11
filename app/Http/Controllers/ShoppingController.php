<?php

namespace App\Http\Controllers;

use Cart;
use App\User;
use App\Product;
use App\Socialmedia;
use App\Contactinf;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function add_to_cart(Request $request)
    {        
        $product = Product::FindOrFail($request->id);
        $cart = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $product->price
        ]);
        Cart::associate($cart->rowId,'App\Product');
        toastr()->success(trans('messages.add_carte'));
        return redirect()->route('mycart');
    }

    public function rapid_add($id){
        $product = Product::FindOrFail($id);
        $cart = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price
        ]);
        Cart::associate($cart->rowId,'App\Product');
        toastr()->success(trans('messages.add_carte'));
        return redirect()->back();
    }

    public function mycart(){
        //frontend layout variable        
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        // end of frontend layout variable
        return view('frontend.mycart',compact('socialmedia','contactinf'));
    }

    public function cart_delete($id){
        Cart::remove($id);
        return redirect()->back();
    }
    //change quantity of product
    public function change_qty(Request $request){
        Cart::update($request->product_id, ['qty' => $request->qty]);
        return redirect()->back();
    }

    public function checkout(){
        //frontend layout variable        
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        // end of frontend layout variable
        if(Cart::content()->count()>0){
        return view('frontend.checkout',compact('socialmedia','contactinf'));}
        else{
            return redirect()->route('home');
        }
    }

    public function apply_order(Request $request){

        $client= User::findOrFail($request->user_id);
        //create order for client who ordred
        $order = $client->orders()->create([]);
        //attache the product that ordred
        $order->products()->attach($request->offres);
        // put the total price in the order
        $order->update([
            'total_price' => Cart::total()
         ]);
         //delete cart orders
         Cart::destroy();
         toastr()->success(trans('messages.add_order'));
         return redirect()->route('home');
    }
}

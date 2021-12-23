<?php

namespace App\Http\Controllers;

use Cart;
use App\User;
use App\Product;
use App\Order;
use App\AttributeValue;
use App\Socialmedia;
use App\Contactinf;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function add_to_cart(Request $request)
    {        
        $product = Product::FindOrFail($request->id);
        if($product->attr_values->count()>0){            
            $request->validate( [
                'p_att' => 'required|array',
                'p_att.*' => 'required|integer',
            ]);
        }
        if ($request->p_att) {
            $cart = Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->qty,
                'price' => $product->price,
                'options' =>['p_att' => $request->p_att],
            ]);
        } else {
            $cart = Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->qty,
                'price' => $product->price
            ]);
        }
        
        
        Cart::associate($cart->rowId,'App\Product');
        toastr()->success(trans('messages.add_carte'));
        return redirect()->route('mycart');
    }

    public function mycart(){
        //frontend layout variable  
        $product_attribute=AttributeValue::all();      
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        // end of frontend layout variable
        return view('frontend.mycart',compact('socialmedia','contactinf','product_attribute'));
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
        //create order for client who ordred with his address and mobile
        $order = $client->orders()->create([]);
        //attache the product that ordred
       // $order->products()->attach($request->offres);
       foreach (Cart::content() as $order_product) {
           if ($order_product->options->p_att) {
               $pa =serialize($order_product->options->p_att);
               $order->products()->attach($order_product->id,[
                'quantity' => $order_product->qty,
                'product_attribute' => $pa,
              ]);
           }else {
            $order->products()->attach($order_product->id,[
                'quantity' => $order_product->qty,
              ]);
           }
           
          
       }
    //    ---------------------------------------
       //And When you returning data use unserialze
    //    ---------------------------------------
        // put the total price in the order
        $order->update([
            'total_price' => Cart::total(),
            'address' => $request->address,
            'state'=> $request->state,
            'country'=> $request->country,
            'mobile'=> $request->mobile,
            'pincode'=> $request->pincode
         ]);
         //delete cart orders
         Cart::destroy();
         toastr()->success(trans('messages.add_order'));
         return redirect()->route('home');
    }

    public function my_orders(){
        //frontend layout variable        
        $socialmedia=Socialmedia::first();
        $contactinf=Contactinf::first();
        // end of frontend layout variable
        return view('frontend.my_orders',compact('socialmedia','contactinf'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Order;
use App\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_orders'])->only('index');
        $this->middleware(['permission:update_orders'])->only('edit');
    }
    public function index()
    { 
        $main_sidebar=4;
        $orders= Order::orderBy('id', 'DESC')->get();
        return view('backend.orders.index', compact('orders','main_sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $main_sidebar=4;  
        return view('backend.orders.edit', compact('order','main_sidebar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->products()->detach();
        $order->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('orders.index');
    }
    public function qty_update(Request $request,Order $order)
    {
        foreach ($order->products as $product) {
            if($product->id==$request->product_id){
            $product->pivot->quantity = $request->qty;
            $product->pivot->save();
             }
         }
         $total_order_price=0;
         foreach ($order->products as $product) {
             $subtotal= $product->price * $product->pivot->quantity;
             $total_order_price = $total_order_price + $subtotal;
         }
         $order->update([
            $order->total_price = $total_order_price,
         ]);

         toastr()->success(trans('messages.Update'));
        return redirect()->back();

    }
    public function update_attr(Request $request,Order $order)
    {
        $pa =serialize($request->p_att);
        foreach ($order->products as $product) {
            if($product->id==$request->product_id){
            $product->pivot->product_attribute = $pa;
            $product->pivot->save();
             }
         }

        toastr()->success(trans('messages.Update'));
        return redirect()->back();

    }

    public function delete_item(Request $request,Order $order){
        if($order->products->count()==1){
            $order->products()->detach();
            $order->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('orders.index');
        }else{
             $order->products()->detach($request->product_id);
         
         return redirect()->route('update_total_order', $order->id);
        }
    }
    
    
    public function update_total_order(Order $order){
        $total_order_price=0;
        foreach ($order->products as $product) {
            $subtotal= $product->price * $product->pivot->quantity;
            $total_order_price = $total_order_price + $subtotal;
        }
        DB::table('orders')->where('id',$order->id)->update(['total_price'=>$total_order_price]);
        return redirect()->route('orders.edit',$order->id);

    }

    public function order_address_update(Request $request,Order $order){
        $order->update([
            'address' => $request->address,
            'state'=> $request->state,
            'country'=> $request->country,
            'pincode'=> $request->pincode
         ]);
         toastr()->success(trans('messages.Update'));
         return redirect()->back();
    }
    
    public function order_status_update(Request $request,Order $order){
        $order->update([
            'status' => $request->status,
            'paid' => $request->paid,
         ]);
         toastr()->success(trans('messages.Update'));
         return redirect()->back();
    }

    
}

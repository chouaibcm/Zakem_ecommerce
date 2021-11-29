<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_coupons'])->only('index');
    }
    public function index()
    {
        $main_sidebar=6;
        $coupons= Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupons.index', compact('coupons','main_sidebar'));
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
        $this->validate($request,[
            'nb_coupon'=>'required',
            'discount'=>'required|numeric',
            'min_price'=>'required|numeric'
        ]);
        $coupon = new Coupon();
        $coupon->nb_coupon = $request->nb_coupon;
        $coupon->discount = $request->discount;
        $coupon->min_price = $request->min_price;
        $coupon->status = $request->status;
        $coupon->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $this->validate($request,[
            'nb_coupon'=>'required',
            'discount'=>'required|numeric',
            'min_price'=>'required|numeric'
        ]);
        $coupon = Coupon::findOrFail($request->id);
        $coupon->update([
            $coupon->nb_coupon = $request->nb_coupon,
            $coupon->discount = $request->discount,
            $coupon->min_price = $request->min_price,
            $coupon->status = $request->status,
        ]);
        toastr()->success(trans('messages.Update'));
        return redirect()->route('coupons.index');
    }

    public function destroy(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        $coupon->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('coupons.index');
    }
}

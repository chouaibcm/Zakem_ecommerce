<?php

namespace App\Http\Controllers;

use Cart;
use App\Coupon;
use Illuminate\Http\Request;
use Session;

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

    public function applycoupon(Request $request){
        $coupon_code=$request->coupon;
        $new_total_price=Cart::total();

        $check_coupon=Coupon::where('nb_coupon',$coupon_code)->count();
        if($check_coupon==0){
            toastr()->error(trans('coupons_trans.no_coupon'));
            return redirect()->back();
        }else{ //CHOCHO2021
            $check_status=Coupon::where('nb_coupon',$coupon_code)->first();
            if($check_status->status==0){
                toastr()->error( trans('coupons_trans.ex_coupon'));
                return redirect()->back();
            }else{
                if ($check_status->min_price<=$new_total_price) {
                    $new_total_price=$new_total_price-$check_status->discount;
                    Session::put('new_total_price',$new_total_price);
                    Session::put('coupon_code',$check_status->id);
                    toastr()->success(trans('coupons_trans.ap_coupon'));
                    return redirect()->back();
                } else {
                    toastr()->error( trans('coupons_trans.totalshippest'));
                    return redirect()->back();
                }
                
            }
        }

    }//end of apply coupon

}

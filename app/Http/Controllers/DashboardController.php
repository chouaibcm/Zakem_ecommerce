<?php

namespace App\Http\Controllers;


use App\Order;
use App\Category;
use App\Product;
use App\User;
use Carbon\Carbon;
use App\Charts\SampleChart;
use Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_dashboards'])->only('index');
    }
    public function index(Request $request)
    {
        $categories_count = Category::count();
        $products_count = Product::count();
        $users_count = User::where('user_role','client')->count();
        $orders_count = Order::count();
        //-------------------------
        $orders_m=Order::whereMonth('created_at', '=', Carbon::now()->startOfMonth()->month)->whereYear('created_at', '=', Carbon::now()->year)->get();
        
        $today_orders = Order::whereDate('created_at', Carbon::today())->get();
        // get order of this month and today
        //-------------------------
        $month_price=self::monthprice($orders_m);
        $today_price=self::monthprice($today_orders);
        //--------------------------------------
        
        // elequent edi ta7ssab ch7al order f yoom f chhar eda 
        $option=0;
        if($request->choose){
            $option=$request->choose;
        }
        if($option == 0){
            $ordersByDay = Order::whereMonth('created_at', '=', Carbon::now()->startOfMonth()->month)->whereYear('created_at', '=', Carbon::now()->year)
                ->groupBy('date')
                ->orderBy('date')
                ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as "orders"')
                ])->pluck('orders','date');
        //-------------------------------------
        
        $chart = new SampleChart;
        $chart->labels($ordersByDay->keys());
        $chart->dataset(trans('orders_trans.title_page'), 'bar',$ordersByDay->values());
        //-------------------------------------
        }
        // elequent edi ta7ssab ch7al order f yoom f  3 chhor li fato
        if($option == 1){
            $ordersByDay = Order::where('created_at', '>=', Carbon::now()->subDays(90))
                ->groupBy('date')
                ->orderBy('date')
                ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as "orders"')
                ])->pluck('orders','date');
        //-------------------------------------
        $chart = new SampleChart;
        $chart->labels($ordersByDay->keys());
        $chart->dataset(trans('orders_trans.title_page'), 'bar',$ordersByDay->values());
        //-------------------------------------
        }
        // elequent edi ta7ssab ch7al order f yoom f 6 chhor li fato
        if($option == 2){
            $ordersByDay = Order::where('created_at', '>=', Carbon::now()->subDays(180))
                ->groupBy('date')
                ->orderBy('date')
                ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as "orders"')
                ])->pluck('orders','date');
        //-------------------------------------
        $chart = new SampleChart;
        $chart->labels($ordersByDay->keys());
        $chart->dataset(trans('orders_trans.title_page'), 'bar',$ordersByDay->values());
        //-------------------------------------
        }
        //top selling
           $topsales=DB::table('product_order')
           ->selectRaw('product_id, sum(quantity) total')
           ->groupBy('product_id')
           ->orderBy('total','desc')
           ->take(10)
           ->get();

           $products=Product::all();
        // ------------------------------------------------
        $main_sidebar=1;
        return view('backend/dashboard',compact('month_price','today_price','chart', 'topsales', 'main_sidebar',
        'categories_count', 'products_count', 'users_count', 'orders_count','products'));
    }
    private function monthprice($orders){
        $month_price=0;
        foreach ($orders as $order) {
        $month_price+= $order->total_price;
        }
        return $month_price;
    }
}

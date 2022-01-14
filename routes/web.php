<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    return 'FINISHED';  
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
   //==============================Partie show all============================
    // Route::get('/', function () {
    //     return view('welcome');
    // });
    
    Auth::routes();
   //==============================Partie User Frontend============================
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/shop', 'HomeController@shop')->name('shop');
    Route::get('/product_detail/{product}', 'HomeController@product_detail')->name('product_detail');
    Route::post('/product/addToCart','ShoppingController@add_to_cart')->name('cart.add');
    Route::get('/cart','ShoppingController@mycart')->name('mycart');
    Route::get('/cart/delete/{id}', 'ShoppingController@cart_delete')->name('cart.delete');
    Route::get('/cart/qty', 'ShoppingController@change_qty')->name('cart.change.qty');
    Route::get('/cart/rapid_add/{id}','ShoppingController@rapid_add')->name('rapid_add');

    // -------------- lazem tconnecti bah troh lel checkout -----------
    Route::middleware(['auth'])->group (function(){
    Route::get('/cart/checkout','ShoppingController@checkout')->name('checkout');
    Route::post('/cart/checkout/apply-order','ShoppingController@apply_order')->name('apply_order');
    Route::get('/{user}/my-orders','ShoppingController@my_orders')->name('my_orders');
    Route::get('/{user}/my-profile','HomeController@my_profile')->name('my_profile');
    Route::put('/{user}/my-profile/update','HomeController@update_profile')->name('update_profile');
    Route::get('/{product}/add-review','HomeController@add_review')->name('add_review');
    Route::post('/{product}/upload-review','HomeController@upload_review')->name('upload_review');
    Route::post('/cart/checkout/applycoupon','CouponController@applycoupon')->name('applycoupon');
    });
   //---------------------------------------------------------------------

   //==============================Partie Admine============================
    Route::middleware(['auth','admin'])->prefix('admin')->group (function(){
    //==============================dashboard============================
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    //==============================Users admins============================
    Route::resource('users', 'UserController');
    //==============================Categories============================
    Route::resource('categories', 'CategoryController');
    //==============================Products============================
    Route::resource('products', 'ProductController');
    //==============================Products attributes============================
    Route::resource('productsatts', 'ProductAttController');
    //==============================Orders============================
    Route::resource('orders', 'OrderController');
    Route::put('/orders/{order}/edit/update_qty','OrderController@qty_update')->name('order.change.qty');//update quantity
    Route::put('/orders/{order}/edit/delete_item', 'OrderController@delete_item')->name('delete_item');//delete item in order
    Route::put('/orders/{order}/edit/update_attr', 'OrderController@update_attr')->name('update_attr');//update attr order
    Route::get('/orders/{order}/edit/update_total_order', 'OrderController@update_total_order')->name('update_total_order');//update order total
    Route::put('/orders/{order}/edit/order_address_update', 'OrderController@order_address_update')->name('order_address_update');//update order shipping address
    Route::put('/orders/{order}/edit/order_status_update', 'OrderController@order_status_update')->name('order_status_update');//update order status

    //==============================clients============================
    Route::get('/clients', 'UserController@Client_index')->name('clients.index');
    Route::get('/clients/show', 'UserController@Client_show')->name('clients.show');
    Route::get('/clients/edit', 'UserController@Client_edit')->name('clients.edit');
    Route::delete('/clients/destroy', 'UserController@Client_destroy')->name('clients.destroy');
    Route::put('/clients/update','UserController@Client_update')->name('clients.update');
    //==============================Coupons============================
    Route::resource('coupons', 'CouponController');
    //==============================First slider============================
    Route::resource('settings', 'FirstSliderController');
    //==============================Social Media============================
    Route::resource('socialmedia', 'SocialmediaController');
    //==============================Contact info============================
    Route::resource('contact', 'ContactinfController');
    
    });
});




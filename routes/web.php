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
    Route::get('/product_detail/{product}', 'HomeController@product_detail')->name('product_detail');
    Route::post('/product/addToCart','ShoppingController@add_to_cart')->name('cart.add');
    Route::get('/cart','ShoppingController@mycart')->name('mycart');
    Route::get('/cart/delete/{id}', 'ShoppingController@cart_delete')->name('cart.delete');
    Route::get('/cart/qty', 'ShoppingController@change_qty')->name('cart.change.qty');
    Route::get('/cart/rapid_add/{id}','ShoppingController@rapid_add')->name('rapid_add');

    // -------------- lazem tconnecti bah troh lel checkout -----------
    Route::middleware(['auth'])->group (function(){
    Route::get('/cart/checkout','ShoppingController@checkout')->name('checkout');
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




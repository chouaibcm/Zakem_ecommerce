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
   //==============================Partie User============================
    Route::get('/', 'HomeController@index')->name('home');

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
    
    });
});




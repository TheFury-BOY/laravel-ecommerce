<?php

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;

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

Route::get('/', function () {
    return view('welcome');
});

/* Products Routes */
Route::get('/boutique', 'ProductsController@index')->name('products.index');
Route::get('/boutique/{slug}', 'ProductsController@show')->name('products.show');
Route::get('/search', 'ProductsController@search')->name('products.search');

Route::group(['middleware' => ['auth']], function () {
    /* Carts Routes */
    Route::get('/panier', 'CartsController@index')->name('carts.index');
    Route::post('/panier/ajouter', 'CartsController@store')->name('carts.store');
    Route::patch('/panier/{rowId}', 'CartsController@update')->name('carts.update');
    Route::delete('/panier/{rowId}', 'CartsController@destroy')->name('carts.destroy');
});

Route::group(['middleware' => ['auth']], function () {
    /* Checkout Routes */
    Route::get('/paiement', 'CheckoutController@index')->name('checkout.index');
    Route::post('/paiement', 'CheckoutController@store')->name('checkout.store');
    Route::get('/merci', 'CheckoutController@thankYou')->name('checkout.thankyou');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
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

/* Carts Routes */
Route::get('/panier', 'CartsController@index')->name('carts.index');
Route::post('/panier/ajouter', 'CartsController@store')->name('carts.store');
Route::delete('/panier/{rowId}', 'CartsController@destroy')->name('carts.destroy');

Route::get('viderpanier', function() {
    Cart::destroy();
});

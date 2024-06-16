<?php

use App\Http\Controllers\HomeCtr;
use App\Http\Controllers\ProductCtr;
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

Route::get('/', [HomeCtr::class, 'index'])->name('home');
Route::get('/product/{slug}', [ProductCtr::class, 'detail'])->name('product.detail');
Route::post('/addcarts', [ProductCtr::class, 'addcarts'])->name('product.addcars');
Route::get('/addcart/{id}', [ProductCtr::class, 'addcart'])->name('product.addcart');
Route::get('/cart', [ProductCtr::class, 'cart'])->name('product.cart');
Route::delete('/removecart', [ProductCtr::class, 'removecart'])->name('remove.cart');
Route::put('/updatecart', [ProductCtr::class, 'updatecart'])->name('update.cart');
Route::get('/cart/checkout', [ProductCtr::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout/comfirm', [ProductCtr::class, 'comfirmcheckout'])->name('comfirmcheckout');

// Admin Route
require __DIR__.'/admin.php';
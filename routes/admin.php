<?php

use App\Http\Controllers\admin\MainCtr;
use App\Http\Controllers\admin\DashboardCtr;
use App\Http\Controllers\admin\OrderCtr;
use App\Http\Controllers\admin\ProductCtr;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('/', [MainCtr::class, 'index'])->name('admin.login');
    Route::get('/login', [MainCtr::class, 'index'])->name('login');
    Route::get('/logout', [MainCtr::class, 'logout'])->name('admin.logout');
    Route::post('/auth', [MainCtr::class, 'auth'])->name('auth.admin');
    Route::post('/tinymce/upload', [MainCtr::class, 'tinymceUpload'])->name('tinymce.upload');

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/dashboard', [DashboardCtr::class, 'index'])->name('admin.dashboard');
        Route::get('/product', [ProductCtr::class, 'index'])->name('admin.product');
        Route::get('/product/create', [ProductCtr::class, 'create'])->name('product.create');
        Route::get('/product/edit/{id}', [ProductCtr::class, 'edit'])->name('product.edit');
        Route::post('/product/store', [ProductCtr::class, 'store'])->name('product.store');
        Route::post('/product/update', [ProductCtr::class, 'update'])->name('product.update');
        Route::delete('/product/destroy/{id}', [ProductCtr::class, 'destroy'])->name('product.destroy');

        // Route Orders list
        Route::get('/order', [OrderCtr::class, 'index'])->name('admin.order');
        Route::get('/order/detail/{id}', [OrderCtr::class, 'detail'])->name('order.detail');
    });
});
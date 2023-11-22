<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UnpaidController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PDF\ReceiptController;

Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login']); 

Route::middleware(['auth' => 'admin'])->group(function() { 
    Route::controller(MenuController::class)->group(function() {
        Route::get('/menu', 'index')->name('db.menu');

        Route::post('/ready/receipt', 'ready_receipt');
        Route::get('/place/order', 'place_order');
    });

    Route::controller(UnpaidController::class)->group(function() {
        Route::get('/unpaid', 'index')->name('db.unpaid');
        
        Route::post('/update/receipt', 'update_receipt');
        Route::post('/reissue/receipt', 'reissue_receipt');
    });

    Route::controller(KitchenController::class)->group(function() {
        Route::get('/kitchen', 'index')->name('db.kitchen'); 

        Route::get('/order/serve/{order_id}', 'order_serve');
        Route::get('/order/cancel/{order_id}', 'order_cancel');
    });

    Route::controller(TransactionController::class)->group(function() {
        Route::get('/transaction', 'index')->name('db.transaction');
    });

    Route::controller(ProductController::class)->group(function() {
        Route::get('/product', 'index')->name('db.product');
    });

    Route::controller(DashboardController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('dashboard');

        Route::get('/date/total_sale/{day}', 'total_sale');
        Route::get('/date/total_customer/{day}', 'total_customer');
        Route::get('/dashboard/total_product', 'total_product');
        Route::get('/dashbaord/product_sale', 'product_sale');
        Route::get('/dashbaord/average_order', 'average_order');
        Route::get('/dashboard/pending_order', 'pending_order');
        Route::get('/dashboard/unpaid_order', 'unpaid_order');
        Route::get('/dashboard/product_reorder', 'product_reorder');
        Route::get('/dashboard/product_low', 'product_low');
        Route::get('/dashboard/out_stock', 'out_stock');
        Route::get('/dashboard/total_staffs', 'total_staffs');
        Route::get('/dashboard/product_best', 'product_best');
        Route::get('/dashboard/unavailable_product', 'unavailable_product');
        Route::get('/dashboard/available_product', 'available_product');
    });

    Route::get('/show/receipt', [ReceiptController::class, 'show_receipt']);
    Route::post('/logout', [LoginController::class, 'logout']);
});
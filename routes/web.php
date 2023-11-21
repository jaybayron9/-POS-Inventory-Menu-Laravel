<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UnpaidController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PDF\ReceiptController;
use App\Http\Controllers\TransactionController;

Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth' => 'admin'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/menu', [MenuController::class, 'index'])->name('db.menu');
    Route::get('/kitchen', [KitchenController::class , 'index'])->name('db.kitchen');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('db.transaction');
    Route::get('/unpaid', [UnpaidController::class , 'index'])->name('db.unpaid');
    Route::get('/product', [ProductController::class, 'index'])->name('db.product');

    Route::post('/ready/receipt', [MenuController::class, 'ready_receipt']);
    Route::get('/show/receipt', [ReceiptController::class, 'show_receipt']);
    Route::get('/place/order', [MenuController::class, 'place_order']);
});
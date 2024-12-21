<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('shop.index');
});

// Public shop routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// Authenticated shopper routes
Route::middleware(['auth'])->group(function () {
    Route::get('/shop/cart', [ShopController::class, 'cart'])->name('shop.cart');
    Route::post('/shop/cart/{product}', [ShopController::class, 'addToCart'])->name('shop.add-to-cart');
    Route::delete('/shop/cart/{id}', [ShopController::class, 'removeFromCart'])->name('shop.remove-from-cart');
    Route::get('/shop/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
    Route::post('/shop/place-order', [ShopController::class, 'placeOrder'])->name('shop.place-order');
    
    // User profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';

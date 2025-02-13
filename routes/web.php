<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/products',[FrontController::class, 'products'])->name('products');
Route::get('/product/{id}',[FrontController::class, 'product'])->name('product');
Route::get('/cart',[FrontController::class, 'cart'])->name('cart');
Route::get('/checkout',[FrontController::class, 'checkout'])->name('checkout');


require __DIR__.'/auth.php';

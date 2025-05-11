<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home & Dashboard
// Route::get('/', function () {
//     return view('index');
// })->name('home');

Route::get('/', [FrontController::class, 'dashboard'])->name('dashboard');

// Route::get('/dashboard', [FrontController::class, 'dashboard'])->name('dashboard');
// Static Pages
Route::controller(FrontController::class)->group(function () {
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/services', 'services')->name('services');
});

// Products
Route::controller(FrontController::class)->group(function () {
    Route::get('/products', 'products')->name('products.index');
    Route::get('/products/{slug}', 'showProduct')->name('products.show');
});

// Shopping Cart
Route::controller(CartController::class)
    ->prefix('cart')
    ->name('cart.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{id}', 'store')->name('store');
        Route::patch('/update/{id}', 'update')->name('update');
        Route::delete('/remove/{id}', 'destroy')->name('destroy');
    });

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // User Profile
    Route::controller(ProfileController::class)
        ->prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', 'edit')->name('edit');
            Route::patch('/', 'update')->name('update');
            Route::delete('/', 'destroy')->name('destroy');
        });

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Checkout Process
    Route::controller(CheckoutController::class)
        ->prefix('checkout')
        ->name('checkout.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/process', 'process')->name('process');
        });


    // Payment Process
    Route::controller(PaymentController::class)
        ->prefix('payment')
        ->name('payment.')
        ->group(function () {
            Route::get('/{order:order_number}', 'index')->name('index');
            Route::post('/{order:order_number}/process', 'process')->name('process');
            Route::get('/{order:order_number}/instructions', 'instructions')->name('instructions');
            Route::get('/{order:order_number}/finish', 'handleFinish')->name('finish');
            Route::get('/{order:order_number}/error', 'handleError')->name('error');
            Route::get('/{order:order_number}/cancel', 'handleCancel')->name('cancel');
        });


    // Order Management
    Route::controller(OrderController::class)
        ->prefix('orders')
        ->name('orders.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{order}', 'show')->name('show');
            Route::post('/{order}/cancel', 'cancel')->name('cancel');
            Route::get('/{order}/track', 'track')->name('track');
            Route::get('/{order}/print', 'print')->name('print')->middleware('admin');
        });

    // Review routes
    Route::get('orders/{order}/products/{product}/review', [ReviewController::class, 'create'])
        ->name('reviews.create');
    Route::post('orders/{order}/products/{product}/review', [ReviewController::class, 'store'])
        ->name('reviews.store');


    // Midtrans Routes
    Route::controller(MidtransController::class)
        ->prefix('midtrans')
        ->name('midtrans.')
        ->group(function () {
            Route::get('/transaction/{order}', 'createTransaction')->name('create-transaction');
        });
});

// Routes that don't need auth
// Route::post('/payment/callback', [PaymentController::class, 'callback'])
//     ->name('payment.callback');

// Route::post('/midtrans/notification', [MidtransController::class, 'handleNotification'])
//     ->name('midtrans.notification');

// Webhook Routes (No auth, No CSRF)
// Route::prefix('webhook')->name('webhook.')->group(function () {
//     Route::post('/midtrans', [PaymentController::class, 'callback'])
//         ->name('midtrans')
//         ->withoutMiddleware(['verify_csrf_token']);
// })->middleware('api');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

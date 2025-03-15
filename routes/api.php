<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

// Midtrans Webhooks
// Route::prefix('webhooks')->group(function () {
//     Route::post('/midtrans', [PaymentController::class, 'callback'])
//         ->name('webhooks.midtrans');
// });


Route::post('webhooks/midtrans', [PaymentController::class, 'callback'])
    ->name('webhooks.midtrans')
    ->withoutMiddleware(['verify_csrf_token']);

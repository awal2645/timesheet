<?php

use Illuminate\Support\Facades\Route;
use Modules\Payment\App\Http\Controllers\PayPalController;
use Modules\Payment\App\Http\Controllers\StripeController;
use Modules\Payment\App\Http\Controllers\PaymentController;
use Modules\Payment\App\Http\Controllers\PricePlanController;

Route::middleware(['web', 'auth'])->group(function () {
    // Price Plans Routes
    Route::prefix('plans')->name('plans.')->group(function () {
        Route::get('/', [PricePlanController::class, 'index'])->name('index');
        Route::get('/create', [PricePlanController::class, 'create'])->name('create');
        Route::post('/', [PricePlanController::class, 'store'])->name('store');
        Route::get('/{plan}/edit', [PricePlanController::class, 'edit'])->name('edit');
        Route::put('/{plan}', [PricePlanController::class, 'update'])->name('update');
        Route::delete('/{plan}', [PricePlanController::class, 'destroy'])->name('destroy');
    });

    // Payment Routes
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::put('/update', [PaymentController::class, 'update'])->name('update');
        Route::get('/checkout/{plan}', [PaymentController::class, 'checkout'])->name('checkout');
        Route::post('/process', [PaymentController::class, 'process'])->name('process');
        Route::get('/success', [PaymentController::class, 'success'])->name('success');
        Route::get('/cancel', [PaymentController::class, 'cancel'])->name('cancel');
    });


       // Stripe payment routes
       Route::controller(StripeController::class)
       ->prefix('stripe')
       ->name('stripe.')
       ->group(function () {
           Route::post('/plan/purchase', 'paymentPurchase')->name('payment.purchase');
           Route::get('/plan/success', 'paymentSuccess')->name('payment.success');
           Route::get('/plan/cancel', 'paymentCancel')->name('payment.cancel');
       });

   // PayPal payment routes
   Route::controller(PayPalController::class)->group(function () {
       Route::post('paypal/payment', 'processTransaction')->name('paypal.post');
       Route::get('success-transaction', 'successTransaction')->name('paypal.successTransaction');
       Route::get('cancel-transaction', 'cancelTransaction')->name('paypal.cancelTransaction');
   });
   
});
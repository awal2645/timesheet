<?php

use Illuminate\Support\Facades\Route;
use Modules\Testimonial\App\Http\Controllers\TestimonialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your module.
|
*/

Route::group(['prefix' => 'testimonial', 'as' => 'testimonial.'], function () {
    Route::get('/', [TestimonialController::class, 'index'])->name('index');
    Route::get('/create', [TestimonialController::class, 'create'])->name('create');
    Route::post('/store', [TestimonialController::class, 'store'])->name('store');
    Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('edit');
    Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('update');
    Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])->name('destroy');
}); 
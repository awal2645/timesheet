<?php

use Illuminate\Support\Facades\Route;
use Modules\Newsletter\App\Http\Controllers\NewsletterController;

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'newsletter', 'as' => 'newsletter.'], function () {
    Route::get('/', [NewsletterController::class, 'index'])->name('index');
    Route::post('/', [NewsletterController::class, 'store'])->name('store');
    Route::delete('/{id}', [NewsletterController::class, 'destroy'])->name('destroy');
}); 
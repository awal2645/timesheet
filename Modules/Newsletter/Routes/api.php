<?php

use Illuminate\Support\Facades\Route;
use Modules\Newsletter\App\Http\Controllers\NewsletterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "api" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['api'], 'prefix' => 'newsletter', 'as' => 'newsletter.'], function () {
    Route::get('/', [NewsletterController::class, 'index'])->name('index');
    Route::post('/', [NewsletterController::class, 'store'])->name('store');
    Route::delete('/{id}', [NewsletterController::class, 'destroy'])->name('destroy');
});

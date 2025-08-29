<?php

use Illuminate\Support\Facades\Route;
use Modules\Newsletter\App\Http\Controllers\NewsletterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'newsletter', 'as' => 'newsletter.'], function () {
    Route::get('/', [NewsletterController::class, 'index'])->name('index');
    Route::post('/', [NewsletterController::class, 'store'])->name('store');
    Route::delete('/{id}', [NewsletterController::class, 'destroy'])->name('destroy');
});

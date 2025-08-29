<?php

use Illuminate\Support\Facades\Route;
use Modules\EmailReminders\App\Http\Controllers\EmailRemindersController;

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

Route::group([], function () {
    Route::resource('emailreminders', EmailRemindersController::class)->names('emailreminders');
    Route::post('emailreminders/{id}/toggle', [EmailRemindersController::class, 'toggle'])->name('emailreminders.toggle');
    Route::post('emailreminders/{id}/send-test', [EmailRemindersController::class, 'sendTest'])->name('emailreminders.send-test');
});

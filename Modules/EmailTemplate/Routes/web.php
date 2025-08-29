<?php

use Illuminate\Support\Facades\Route;
use Modules\EmailTemplate\App\Http\Controllers\EmailTemplateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your module.
|
*/

Route::group(['prefix' => 'email-template', 'as' => 'emailtemplate.'], function () {
    Route::get('/', [EmailTemplateController::class, 'index'])->name('index');
    Route::post('/save', [EmailTemplateController::class, 'save'])->name('save');
    Route::get('/get-formatted-text/{type}', [EmailTemplateController::class, 'getFormattedTextByType'])->name('get-formatted-text');
}); 
<?php

use Illuminate\Support\Facades\Route;
use Modules\Notice\App\Http\Controllers\NoticeController;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::resource('notices', NoticeController::class)->names('notices');
    Route::get('notices/{notice}/end', [NoticeController::class, 'end'])->name('notices.end');
}); 
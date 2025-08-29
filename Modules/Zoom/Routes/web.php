<?php

use Illuminate\Support\Facades\Route;
use Modules\Zoom\App\Http\Controllers\MeetingController;

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'zoom', 'as' => 'zoom.'], function () {
    Route::get('meetings', [MeetingController::class, 'index'])->name('meeting.index');
    Route::get('meetings/create', [MeetingController::class, 'create'])->name('meeting.create');
    Route::post('meetings', [MeetingController::class, 'store'])->name('meeting.store');
    Route::put('meetings/{meeting}', [MeetingController::class, 'update'])->name('meeting.update');
    Route::delete('meetings/{meeting}', [MeetingController::class, 'destroy'])->name('meeting.destroy');
}); 
<?php

use Illuminate\Support\Facades\Route;
use Modules\Language\App\Http\Controllers\LanguageController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::prefix('admin/settings')->group(function () {
        Route::get('languages', [LanguageController::class, 'index'])->name('languages.index');
        Route::get('languages/create', [LanguageController::class, 'create'])->name('languages.create');
        Route::post('languages', [LanguageController::class, 'store'])->name('languages.store');
        Route::get('languages/{language}/edit', [LanguageController::class, 'edit'])->name('languages.edit');
        Route::put('languages/{language}', [LanguageController::class, 'update'])->name('languages.update');
        Route::delete('languages/{language}', [LanguageController::class, 'destroy'])->name('languages.destroy');
        Route::get('languages/{code}/edit-json', [LanguageController::class, 'editJson'])->name('languages.json.edit');
        Route::post('languages/update-translations', [LanguageController::class, 'transUpdate'])->name('languages.trans.update');
    });
}); 
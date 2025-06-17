<?php

use Illuminate\Support\Facades\Route;
use Modules\BackupRestore\App\Http\Controllers\BackupRestoreController;

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

Route::prefix('backuprestore')->name('backuprestore.')->middleware(['auth:sanctum', 'verified'])->group(function() {
    // Dashboard
    Route::get('/', [BackupRestoreController::class, 'index'])->name('index');
    
    // Backup operations
    Route::post('/backup/full', [BackupRestoreController::class, 'createFullBackup'])->name('backup.full');
    Route::post('/backup/database', [BackupRestoreController::class, 'createDatabaseBackup'])->name('backup.database');
    Route::post('/backup/files', [BackupRestoreController::class, 'createFilesBackup'])->name('backup.files');
    
    // Restore operations
    Route::post('/restore', [BackupRestoreController::class, 'restoreBackup'])->name('restore');
    
    // Backup management
    Route::delete('/backup/delete', [BackupRestoreController::class, 'deleteBackup'])->name('backup.delete');
    Route::get('/backup/download', [BackupRestoreController::class, 'downloadBackup'])->name('backup.download');
});

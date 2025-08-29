<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\DesktopController;
use App\Http\Controllers\Api\AuthController;

// Desktop app authentication
Route::post('/desktop/login', [AuthController::class, 'desktopLogin']);

Route::middleware('auth:sanctum')->group(function () {
    // Desktop app endpoints
    Route::prefix('desktop')->group(function () {
        Route::get('health', [DesktopController::class, 'healthCheck']);
        
        // Time report endpoints
        Route::get('time-report/current', [DesktopController::class, 'getCurrentTimeReport']);
        Route::post('time-report', [DesktopController::class, 'createTimeReport']);
        
        // Store activity data in time_reports table
        Route::post('activity', function(Request $request) {
            try {
                return app(DesktopController::class)->storeActivity($request);
            } catch (\Exception $e) {
                Log::error('Desktop activity error: ' . $e->getMessage(), [
                    'user_id' => $request->user()->id ?? 'unknown',
                    'data' => $request->all()
                ]);
                return response()->json(['error' => 'Failed to store activity data'], 500);
            }
        });
    });
    
    Route::post('/desktop/logout', [AuthController::class, 'desktopLogout']);
});

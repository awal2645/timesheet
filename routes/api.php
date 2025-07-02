<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User search for EmailReminders
Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/users/search', function (Request $request) {
        try {
            $query = $request->input('query');
            
            if (empty($query) || strlen($query) < 2) {
                return response()->json(['users' => []]);
            }
            
            $users = User::where(function ($q) use ($query) {
                $q->where('username', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->select('id', 'username', 'name', 'email')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->username ?: ($user->name ?: $user->email),
                    'email' => $user->email
                ];
            });
            
            return response()->json(['users' => $users]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Search failed',
                'message' => $e->getMessage()
            ], 500);
        }
    });

    // Mention users endpoint for task comments
    Route::get('/mention-users', function (Request $request) {
        try {
            $taskId = $request->input('task_id');
            
            if (!$taskId) {
                return response()->json([]);
            }
            
            // Get the task with its specific employee only
            $task = \App\Models\Task::with(['employee.user'])->find($taskId);
            
            if (!$task) {
                return response()->json([]);
            }
            
            $users = collect();
            
            // Add only the task's assigned employee if they have a user account with email
            if ($task->employee && $task->employee->user && $task->employee->user->email) {
                $employee = $task->employee->user;
                $users->push([
                    'id' => $employee->id,
                    'username' => $employee->username,
                    'email' => $employee->email,
                    'name' => $task->employee->employee_name,
                    'role' => 'employee',
                    'display_name' => $employee->email, // Show email as display name
                ]);
            }
            
            return response()->json($users);
            
        } catch (\Exception $e) {
            Log::error('Mention users API error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Could not load users',
                'message' => $e->getMessage()
            ], 500);
        }
    });
});

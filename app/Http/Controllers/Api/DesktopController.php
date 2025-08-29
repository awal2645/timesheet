<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DesktopController extends Controller
{
    public function healthCheck()
    {
        return response()->json(['status' => 'ok']);
    }

    public function getCurrentTimeReport(Request $request)
    {
        try {
            $today = Carbon::now()->startOfDay();
            
            $timeReport = TimeReport::where('user_id', $request->user()->id)
                ->whereDate('created_at', $today)
                ->first();
                
            if (!$timeReport) {
                return response()->json(['message' => 'No time report found for today'], 404);
            }
            
            return response()->json([
                'time_report_id' => $timeReport->id,
                'start_time' => $timeReport->start_time,
                'status' => $timeReport->status
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting time report: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get time report'], 500);
        }
    }
    
    public function createTimeReport(Request $request)
    {
        try {
            $request->validate([
                'start_time' => 'required|date',
                'status' => 'required|string'
            ]);

            $user = $request->user();
            
            // Get employer_id and employee_id from user
            if (!$user->employee) {
                Log::error('User missing employee or employer ID', [
                    'user_id' => $user->id,
                    'employee_id' => $user->employee_id,
                    'employer_id' => $user->employer_id
                ]);
                return response()->json([
                    'error' => 'User not properly configured with employer/employee'
                ], 400);
            }

            $timeReport = new TimeReport();
            $timeReport->user_id = $user->id;
            $timeReport->employer_id = $user->employee->employer_id;
            $timeReport->employee_id = $user->employee->id;
            $timeReport->start_time = $request->start_time;
            $timeReport->status = $request->status;
            $timeReport->total_time = 0;
            $timeReport->productive_time = 0;
            $timeReport->idle_time = 0;
            $timeReport->start_day = Carbon::parse($request->start_time)->format('Y-m-d');
            $timeReport->end_day = Carbon::parse($request->start_time)->format('Y-m-d');
            $timeReport->save();
            
            Log::info('Time report created successfully', [
                'time_report_id' => $timeReport->id,
                'user_id' => $user->id
            ]);
            
            return response()->json([
                'time_report_id' => $timeReport->id,
                'message' => 'Time report created successfully'
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating time report: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create time report'], 500);
        }
    }

    public function storeActivity(Request $request)
    {
        try {
            $request->validate([
                'time_report_id' => 'required|exists:time_reports,id',
                'total_time' => 'required|integer',
                'productive_time' => 'required|integer',
                'idle_time' => 'required|integer',
                'activity_data' => 'required|json',
                'status' => 'required|string'
            ]);

            $timeReport = TimeReport::findOrFail($request->time_report_id);
            
            // Decode and process activity data
            $activityData = json_decode($request->activity_data, true);
            
            // Calculate app usage statistics
            $appStats = [];
            if (isset($activityData['applications'])) {
                foreach ($activityData['applications'] as $appName => $appData) {
                    $appStats[$appName] = [
                        'total_time' => $appData['time'],
                        'last_active' => $appData['last_seen'],
                        'performance' => [
                            'cpu' => $appData['cpu_usage'],
                            'memory' => $appData['memory_usage']
                        ]
                    ];
                }
            }
            
            // Prepare activity summary
            $activitySummary = [
                'apps' => $appStats,
                'current_app' => $activityData['current_window']['name'] ?? 'unknown',
                'last_update' => $activityData['last_update'],
                'system_metrics' => [
                    'current_cpu' => $activityData['current_window']['cpu_percent'] ?? 0,
                    'current_memory' => $activityData['current_window']['memory_usage'] ?? 0
                ]
            ];
            
            // Log detailed activity data
            Log::info('Activity data received', [
                'time_report_id' => $timeReport->id,
                'total_time' => $request->total_time,
                'productive_time' => $request->productive_time,
                'idle_time' => $request->idle_time,
                'status' => $request->status,
                'activity_summary' => $activitySummary
            ]);
            
            // Update time report with processed activity data
            $timeReport->update([
                'total_time' => $request->total_time,
                'productive_time' => $request->productive_time,
                'idle_time' => $request->idle_time,
                'activity_data' => $activitySummary,
                'status' => $request->status
            ]);
            
            return response()->json([
                'message' => 'Activity data stored successfully',
                'summary' => [
                    'total_time' => $request->total_time,
                    'productive_time' => $request->productive_time,
                    'idle_time' => $request->idle_time,
                    'apps_tracked' => count($appStats)
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error storing activity: ' . $e->getMessage(), [
                'request_data' => $request->all()
            ]);
            return response()->json(['error' => 'Failed to store activity data'], 500);
        }
    }
} 
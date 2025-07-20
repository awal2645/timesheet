<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'last_activity' => 'datetime',
        'activity_data' => 'array',
        'total_time' => 'integer',
        'productive_time' => 'integer',
        'idle_time' => 'integer',
        'productivity_score' => 'float',
        'effectiveness_score' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class, 'user_id', 'user_id')
            ->whereBetween('date', [$this->start_day, $this->end_day]);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function screenshots()
    {
        return $this->hasMany(Screenshot::class);
    }

    public function updateActivityData($activityData)
    {
        $this->update([
            'end_time' => now(),
            'total_time' => $activityData['total_time'] ?? $this->total_time,
            'productive_time' => $activityData['productive_time'] ?? $this->productive_time,
            'idle_time' => $activityData['idle_time'] ?? $this->idle_time,
            'activity_data' => $activityData['activity_data'] ?? $this->activity_data,
            'current_status' => $activityData['status'] ?? 'online',
            'last_activity' => now(),
            'productivity_score' => $activityData['productivity_score'] ?? $this->productivity_score,
            'effectiveness_score' => $activityData['effectiveness_score'] ?? $this->effectiveness_score
        ]);
    }

    public function markAsOffline()
    {
        $this->update([
            'current_status' => 'offline',
            'end_time' => now()
        ]);
    }
}

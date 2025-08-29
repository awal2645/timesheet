<?php

namespace Modules\EmailReminders\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\EmailReminders\Database\factories\EmailReminderFactory;
use App\Models\User;
use Modules\EmailReminders\App\Models\ReminderTemplate;

class EmailReminder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'frequency',
        'reminder_days_before',
        'reminder_time',
        'recipients',
        'recipient_type',
        'template_id',
        'conditions',
        'is_active',
        'last_sent_at',
        'next_run_at',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'recipients' => 'array',
        'conditions' => 'array',
        'is_active' => 'boolean',
        'last_sent_at' => 'datetime',
        'next_run_at' => 'datetime',
        'reminder_time' => 'datetime:H:i:s',
    ];

    /**
     * Get the user who created this reminder.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this reminder.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the reminder template.
     */
    public function template()
    {
        return $this->belongsTo(ReminderTemplate::class, 'template_id');
    }

    /**
     * Scope to get active reminders.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get reminders due for sending.
     */
    public function scopeDue($query)
    {
        return $query->where('next_run_at', '<=', now())
                    ->where('is_active', true);
    }

    /**
     * Get recipient emails based on recipient type.
     */
    public function getRecipientEmails()
    {
        switch ($this->recipient_type) {
            case 'specific':
                return $this->recipients;
                
            case 'role':
                return User::whereHas('roles', function($query) {
                    $query->whereIn('name', $this->recipients);
                })->pluck('email')->toArray();
                
            case 'department':
                return User::whereIn('department', $this->recipients)
                          ->pluck('email')->toArray();
                          
            case 'all':
                return User::pluck('email')->toArray();
                
            default:
                return $this->recipients ?? [];
        }
    }

    /**
     * Calculate next run time based on frequency.
     */
    public function calculateNextRun()
    {
        $now = now();
        $time = $this->reminder_time;
        
        switch ($this->frequency) {
            case 'once':
                return null; // Don't schedule again
                
            case 'daily':
                $next = $now->copy()->addDay();
                break;
                
            case 'weekly':
                $next = $now->copy()->addWeek();
                break;
                
            case 'monthly':
                $next = $now->copy()->addMonth();
                break;
                
            default:
                return null;
        }
        
        // Set the time to the configured reminder time
        if ($time) {
            $next->setTimeFromTimeString($time);
        }
        
        return $next;
    }

    /**
     * Mark reminder as sent and schedule next run.
     */
    public function markAsSent()
    {
        $this->update([
            'last_sent_at' => now(),
            'next_run_at' => $this->calculateNextRun(),
        ]);
    }
    
    // protected static function newFactory(): EmailReminderFactory
    // {
    //     //return EmailReminderFactory::new();
    // }
}

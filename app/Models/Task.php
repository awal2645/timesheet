<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'employer_id',
        'employee_id', 
        'project_id',
        'task_name',
        'description',
        'task_type',
        'labels',
        'time',
        'priority',
        'due_date',
        'status',
        'estimated_hours',
        'logged_hours'
    ];

    protected $casts = [
        'labels' => 'array',
        'due_date' => 'date',
        'estimated_hours' => 'decimal:2',
        'logged_hours' => 'decimal:2'
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function attachments()
    {
        return $this->hasMany(TaskAttachment::class);
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class)->latest();
    }

    // Accessor for task type badge color
    public function taskTypeBadgeColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->task_type) {
                'task' => 'bg-blue-100 text-blue-800',
                'story' => 'bg-green-100 text-green-800', 
                'bug' => 'bg-red-100 text-red-800',
                'epic' => 'bg-purple-100 text-purple-800',
                default => 'bg-gray-100 text-gray-800'
            }
        );
    }

    // Accessor for priority badge color
    public function priorityBadgeColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->priority) {
                'high' => 'bg-red-100 text-red-800',
                'medium' => 'bg-yellow-100 text-yellow-800',
                'low' => 'bg-green-100 text-green-800',
                default => 'bg-gray-100 text-gray-800'
            }
        );
    }

    // Accessor for status badge color
    public function statusBadgeColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->status) {
                'pending' => 'bg-yellow-100 text-yellow-800',
                'inprogress' => 'bg-blue-100 text-blue-800',
                'completed' => 'bg-green-100 text-green-800',
                default => 'bg-gray-100 text-gray-800'
            }
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        // Listen for the 'deleting' event on the Employee model
        static::deleting(function ($employee) {
            // Delete associated user data
            $employee->user()->delete();
        });
    }

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function leave()
    {
        return $this->hasOne(LeaveApplication::class);
    }
    
    // Add this new method to count approved leave applications
    public function approvedLeaveCount()
    {
        return $this->hasMany(LeaveApplication::class)->where('status', 'approved')->count();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}

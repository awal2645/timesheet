<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'employer_id');
    }

    protected static function booted()
    {
        static::deleting(function ($employer) {
            // Loop through all employees associated with the employer
            foreach ($employer->employee as $employee) {
                // Delete the associated user
                $employee->user()->delete(); // Assumes each employee has a user relationship
                $employee->delete(); // Optionally delete the employee as well
            }
        });
    }

    public function client()
    {
        return $this->hasMany(Client::class, 'employer_id');
    }

    public function project()
    {
        return $this->hasMany(Project::class, 'employer_id');
    }

    public function userPlan()
    {
        return $this->hasOne(UserPlan::class, 'employer_id');
    }
}

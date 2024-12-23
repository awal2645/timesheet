<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyHoliday extends Model
{
    protected $fillable = ['days_of_week', 'created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function timeReport()
    {
        return $this->belongsTo(TimeReport::class, 'user_id', 'user_id');
    }

    
}

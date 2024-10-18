<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeReport extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        return $this->belongsTo(Client::class, 'client_id'); // Adjust 'client_id' if your column name differs
    }
}

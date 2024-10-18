<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'employer_id');
    }

    // Define the inverse relationship (if needed)
    public function timeReports()
    {
        return $this->hasMany(TimeReport::class);
    }
}

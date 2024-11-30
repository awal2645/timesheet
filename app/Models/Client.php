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

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

   
    public function totalProject()
    {
        return $this->projects()->count();
    }

    public function totalTask()
{
    return Task::whereIn('project_id', $this->projects()->pluck('id'))->count();
}

}

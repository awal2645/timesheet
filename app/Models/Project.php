<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}

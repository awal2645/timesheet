<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'comment',
        'edited_at'
    ];

    protected $casts = [
        'edited_at' => 'datetime'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if comment was edited
    public function wasEdited()
    {
        return !is_null($this->edited_at);
    }

    // Get the author's name
    public function getAuthorNameAttribute()
    {
        return $this->user->name ?? $this->user->username ?? 'Unknown User';
    }
}

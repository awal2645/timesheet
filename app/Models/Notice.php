<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = ['title', 'content', 'role', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role');
    }
}

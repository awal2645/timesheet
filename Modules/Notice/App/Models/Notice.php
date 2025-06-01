<?php

namespace Modules\Notice\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'role',
        'created_by',
        'status',
        'end_date'
    ];

    /**
     * Get the user who created the notice
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    /**
     * Get the roles that can see this notice
     */
    public function roles(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Role::class, 'role');
    }
} 
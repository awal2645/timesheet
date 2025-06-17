<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TaskAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'original_name',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'mime_type'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if file is an image
    public function isImage()
    {
        return in_array($this->file_type, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
    }

    // Get file size in human readable format
    public function getFileSizeHumanAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Get full file URL
    public function getUrlAttribute()
    {
        return Storage::url($this->file_path);
    }

    // Delete file when model is deleted
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($attachment) {
            Storage::delete($attachment->file_path);
        });
    }
}

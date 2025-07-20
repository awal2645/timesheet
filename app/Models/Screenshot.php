<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'time_report_id',
        'file_path',
        'thumbnail_path',
        'taken_at',
        'window_details',
        'activity_type'
    ];

    protected $casts = [
        'taken_at' => 'datetime',
        'window_details' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function timeReport()
    {
        return $this->belongsTo(TimeReport::class);
    }

    // Get the full URL for the screenshot
    public function getScreenshotUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    // Get the full URL for the thumbnail
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path ? asset('storage/' . $this->thumbnail_path) : null;
    }
} 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'primary_color',
        'secondary_color',
        'sidebar_dark',
        'sidebar_light',
        'header_dark',
        'header_light',
        'body_dark',
        'body_light',
        'font_family',
        'is_active'
    ];

    public static function getActive()
    {
        return static::where('is_active', true)->first() ?? static::create([
            'primary_color' => '#0d6efd',
            'secondary_color' => '#6c757d',
            'font_family' => 'Inter',
            'is_active' => true
        ]);
    }
} 
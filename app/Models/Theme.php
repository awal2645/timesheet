<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'primary_color',
        'card_dark',
        'card_light',
        'sidebar_dark',
        'sidebar_light',
        'header_dark',
        'header_light',
        'body_dark',
        'body_light',
        'font_family',
        'text_light',
        'text_dark'
    ];

    // Add default colors and fonts as constants
    const DEFAULT_COLORS = [
        'primary_color' => '#04a9f5',
        'card_dark' => '#000000',
        'card_light' => '#ffffff',
        'sidebar_dark' => '#0c0f12',
        'sidebar_light' => '#ffffff',
        'header_dark' => '#0f1215',
        'header_light' => '#f8f9fa',
        'body_dark' => '#0f1215',
        'body_light' => '#f8f9fa',
        'text_light' => '#090606',
        'text_dark' => '#cfd3d0',
        'font_family' => 'Inter'
    ];

    // Add available fonts
    const AVAILABLE_FONTS = [
        'Inter' => "'Inter', sans-serif",
        'Poppins' => "'Poppins', sans-serif",
        'Roboto' => "'Roboto', sans-serif",
        'Open Sans' => "'Open Sans', sans-serif",
        'Montserrat' => "'Montserrat', sans-serif"
    ];

    public static function getTheme()
    {
        return static::first(); // Get the first theme (assuming only one exists)
    }

    // Add getter for font family with fallback
    public function getFontFamilyStyleAttribute()
    {
        return self::AVAILABLE_FONTS[$this->font_family] ?? self::AVAILABLE_FONTS['Inter'];
    }
} 
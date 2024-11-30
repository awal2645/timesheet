<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        // Check if a theme already exists
        if (Theme::count() == 0) {
            Theme::create([
                'primary_color' => '#04a9f5',
                'card_dark' => '#1b232d',
                'card_light' => '#ffffff',
                'sidebar_dark' => '#1d2630',
                'sidebar_light' => '#ffffff',
                'header_dark' => '#0f1215',
                'header_light' => '#f8f9fa',
                'body_dark' => '#131920',
                'body_light' => '#f4f7fa',
                'text_light' => '#090606',
                'text_dark' => '#cfd3d0',
                'font_family' => 'Inter',
            ]);
        }
    }
}

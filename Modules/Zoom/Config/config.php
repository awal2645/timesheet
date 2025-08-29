<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Zoom Module Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can define all of the configuration settings for the Zoom module.
    |
    */

    'enabled' => env('ZOOM_ENABLED', true),
    
    'api_url' => env('ZOOM_API_URL', 'https://api.zoom.us/v2/'),
    
    'default_settings' => [
        'host_video' => false,
        'participant_video' => false,
        'waiting_room' => true,
    ],
    
    'meeting_types' => [
        'instant' => 1,
        'scheduled' => 2,
        'recurring' => 3,
        'fixed_recurring' => 8,
    ],
]; 
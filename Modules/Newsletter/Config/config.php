<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Newsletter Module Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can define all of the configuration settings for the Newsletter module.
    |
    */

    'name' => 'Newsletter',
    'description' => 'Newsletter subscription management module',
    
    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Number of items to show per page in the newsletter subscribers list.
    |
    */
    'per_page' => 10,

    /*
    |--------------------------------------------------------------------------
    | Email Validation
    |--------------------------------------------------------------------------
    |
    | Rules for validating email addresses during subscription.
    |
    */
    'email_validation' => [
        'rules' => 'required|email|unique:newsletters,email',
        'messages' => [
            'required' => 'The email field is required.',
            'email' => 'Please enter a valid email address.',
            'unique' => 'This email is already subscribed to our newsletter.',
        ],
    ],
]; 
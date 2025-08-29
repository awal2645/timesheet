<?php

return [
    'name' => 'Newsletter',
    'email_validation' => [
        'rules' => ['required', 'email', 'unique:newsletters,email'],
        'messages' => [
            'required' => 'Email address is required.',
            'email' => 'Please enter a valid email address.',
            'unique' => 'This email address is already subscribed to our newsletter.',
        ],
    ],
];

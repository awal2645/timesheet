<?php

return [
    'paypal_sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', 'AfXp2EX11Pym1k26wUL1vLFvvdY79LKozOPGS3lSybQMXx2YhELwzLnoWJdIcpwmkH80g42vLV-0yVPc'),
    'paypal_sandbox_secret' => env('PAYPAL_SANDBOX_SECRET', 'ENC16VzMJnnXlplrCEbieptcfy3RLG2G-4gqPS4646AYCmQGyx_tPL8ira6nLobyX0j3NAnYENfZ84XQ'),
    'paypal_live_client_id' => env('PAYPAL_LIVE_CLIENT_ID', 'AfXp2EX11Pym1k26wUL1vLFvvdY79LKozOPGS3lSybQMXx2YhELwzLnoWJdIcpwmkH80g42vLV-0yVPc-3DkE2TFWt873wGRPYBOTb'),
    'paypal_live_secret' => env('PAYPAL_LIVE_SECRET', 'ENC16VzMJnnXlplrCEbieptcfy3RLG2G-4gqPS4646AYCmQGyx_tPL8ira6nLobyX0j3NAnYENfZ84XQ'),
    'paypal_mode' => env('PAYPAL_MODE', 'sandbox'),
    'paypal_active' => env('PAYPAL_ACTIVE', true),

    'stripe_key' => env('STRIPE_KEY', 'pk_test_51JAbnoDHsbz9CBNMjbDtUrA8pfBWkC9yvXqzFQYHeEJokRKFvpAedEruhqCxJhzqOflDi0KH1E020J5kitkMWV4q00fl2LBk6p'),
    'stripe_secret' => env('STRIPE_SECRET', 'sk_test_51JAbnoDHsbz9CBNM3FjZDwFH9rC3sr8q06vu9dDS0cjzY0o7a0VnC5KbcED1YUAEcryuro0xkDUKq8rKqVi1R9SX00idI7OL7i'),
    'stripe_active' => env('STRIPE_ACTIVE', true),

    'module_commands' => [
        'create' => 'php artisan module:make Payment',
        'enable' => 'php artisan module:enable Payment',
        'disable' => 'php artisan module:disable Payment',
    ],
]; 
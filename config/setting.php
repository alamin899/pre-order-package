<?php

return [

    'route_path' => 'pre-order',

    'timezone' => null,

    'middleware' => [
        'web',
    ],

    'api_middleware' => [

    ],

    'google' => [
        'api_site_key' => env('GOOGLE_RECAPTCHA_SITE_KEY', ''),

        'api_secret_key' => env('GOOGLE_RECAPTCHA_SECRET_KEY', ''),

        'token_verify_url' => 'https://www.google.com/recaptcha/api/siteverify',

        'version' => 'v3',

        'skip_ip' => env('GOOGLE_RECAPTCHA_SKIP_IP', []),
        'bypass_captcha' => env('GOOGLE_RECAPTCHA_BYPASS', false),
    ]
];

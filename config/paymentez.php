<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Paymentez Api Key
    |--------------------------------------------------------------------------
    |
    | This value is the api key of your paymentez account.
    |
    */
    'api_key' => env('PAYMENTEZ_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Paymentez Api Code
    |--------------------------------------------------------------------------
    |
    | This value is the api code of your paymentez account.
    |
    */
    'api_code' => env('PAYMENTEZ_API_CODE'),

    /*
    |--------------------------------------------------------------------------
    | Paymentez Environment
    |--------------------------------------------------------------------------
    |
    | This value is the environment of your paymentez account.
    | Options: true (production), false (staging)
    |
    */
    'production' => env('PAYMENTEZ_PRODUCTION', false),


    /*
    |--------------------------------------------------------------------------
    | Default Seconds Timeout
    |--------------------------------------------------------------------------
    |
    | This value is the default timeout in seconds for Paymentez requests.
    |
    */
    'default_seconds_timeout' => env('PAYMENTEZ_DEFAULT_SECONDS_TIMEOUT', 90),

    /*
    |--------------------------------------------------------------------------
    | Paymentez API Version
    |--------------------------------------------------------------------------
    |
    | This value is the version of the Paymentez API to be used.
    |
    */
    'api_version' => env('PAYMENTEZ_API_VERSION', 'v2'),
    /*
    |--------------------------------------------------------------------------
    | Paymentez Base URIs
    |--------------------------------------------------------------------------
    |
    | These values are the base URIs of your paymentez account.
    | Options: production (true), staging (false)
    |
    */
    'base_url' => [
        'ccapi' => env('PAYMENTEZ_CCAPI_URL', 'https://ccapi-stg.paymentez.com'),
        'noccapi' =>  env('PAYMENTEZ_NOCCAPI_URL', 'https://noccapi-stg.paymentez.com')
    ],

    /*
    |--------------------------------------------------------------------------
    | Paymentez API Resources
    |--------------------------------------------------------------------------
    |
    | These values are the api resources of your paymentez account.
    | Options: card, cash, charge
    |
    */
    'api_resources' => [
        'card' => [
            'class' => \Blubear\LaravelPaymentez\Resources\Card::class,
            'api' => 'ccapi'
        ],
        'cash' => [
            'class' => \Blubear\LaravelPaymentez\Resources\Cash::class,
            'api' => 'noccapi'
        ],
        'charge' => [
            'class' => \Blubear\LaravelPaymentez\Resources\Charge::class,
            'api' => 'ccapi'
        ]
    ],
    'default_headers' => [
        'Content-Type' => 'application/json',
    ]
];

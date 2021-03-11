<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SConnect Root Url
    |--------------------------------------------------------------------------
    */
    'root_url' => env('S_CONNECT_URL'),

    /*
    |--------------------------------------------------------------------------
    | API Key to access internal APIs
    |--------------------------------------------------------------------------
    */
    'api_key' => env('S_CONNECT_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Custom models
    |--------------------------------------------------------------------------
    | Your models to which SConnect data should be returned.
    |
    | Your own models should extends the base models.
    |
    */
    'models' => [
        'user' => \App\User::class,
        'position' => '\SonLeu\SConnect\Models\Position',
        'department' => '\SonLeu\SConnect\Models\Department',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    */
    'cache' => [
        'ttl' => env('S_CONNECT_CACHE_TTL', 300),
    ],
];

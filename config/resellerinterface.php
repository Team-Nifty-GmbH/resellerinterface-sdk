<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ResellerInterface API Configuration
    |--------------------------------------------------------------------------
    |
    | These settings are used to configure the ResellerInterface SDK
    | for API authentication and connection.
    |
    */

    'username' => env('RESELLERINTERFACE_USERNAME'),
    'password' => env('RESELLERINTERFACE_PASSWORD'),
    'reseller_id' => env('RESELLERINTERFACE_RESELLER_ID'),
    'base_url' => env('RESELLERINTERFACE_BASE_URL', 'https://core.resellerinterface.de'),
];

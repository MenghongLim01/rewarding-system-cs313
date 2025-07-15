<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset "broker" for your application. You may change these defaults
    | as required.
    |
    */

    'defaults' => [
        'guard' => 'admin',
        'passwords' => 'admins',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here you may define every authentication guard for your application.
    | A typical configuration uses session storage and the Eloquent provider.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'user' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
         'web' => [
        'driver' => 'session',
        'provider' => 'users',
        ],
        'staff' => [
            'driver' => 'session',
            'provider' => 'staff', // This is the provider we'll configure next
        ],
    ],



    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Defines how users (admins in this case) are retrieved from storage.
    | We're using Eloquent with a custom Admin model.
    |
    */

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
         'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'staff' => [
            'driver' => 'eloquent',
            'model' => App\Models\Staff::class,  // Make sure this model points to the Staff model
        ],
    ],
    


    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords (Optional for Admins)
    |--------------------------------------------------------------------------
    |
    | You can use this to reset admin passwords if needed. Laravel will store
    | tokens in the 'password_reset_tokens' table by default.
    |
    */

    'passwords' => [
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | The number of seconds before a password confirmation expires.
    | Default is 3 hours (10800 seconds).
    |
    */

    'password_timeout' => 10800,

];

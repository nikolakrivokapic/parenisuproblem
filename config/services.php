<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],


'facebook' => [
    'client_id' => '194532727575239',
    'client_secret' => 'dde8ba7ec2ddacf5fb29dd09e78df900',
    'redirect' => 'http://phplaravel-12652-27729-91017.cloudwaysapps.com/auth/callback/facebook',
],

'google' => [
    'client_id' => '6691310333-6bv25tajiuv8ms7l3a8rv5j62c2boh16.apps.googleusercontent.com',
    'client_secret' => 'K6ZsZlHTkMVACapy6Kb_KxpC',
    'redirect' => 'http://phplaravel-12652-27729-91017.cloudwaysapps.com/auth/callback/google',
]


];

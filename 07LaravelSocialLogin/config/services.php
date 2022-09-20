<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '1157025951547528', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => 'c4c6802615bd7c732d3b72d3a2af4a0e', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => '/facebook/callback'
    ],
    'google' => [
        'client_id' => '128114575538-ctdcltaamrtog4qhqmlcq0va0tkj3vo3.apps.googleusercontent.com', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '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', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => '/google/callback'
    ],
];

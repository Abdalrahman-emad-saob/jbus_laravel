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

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => '/api/v1/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => '/api/v1/auth/facebook/callback',
    ],
    // 'firebase' => [
    //     'credentials' => [
    //         'file' => storage_path('jbus-8f9bf-firebase-adminsdk-ai17o-df9754ead0.json'),
    //     ],
    //     'database_url' => 'https://console.firebase.google.com/u/0/project/jbus-8f9bf/database/jbus-8f9bf-default-rtdb/data/~2F',
    // ],

    // 'firebase' => [
    //     'apiKey' => env('FIREBASE_API_KEY'),
    //     'authDomain' => env('FIREBASE_AUTH_DOMAIN'),
    //     'databaseURL' => env('FIREBASE_DATABASE_URL'),
    //     'projectId' => env('FIREBASE_PROJECT_ID'),
    //     'storageBucket' => env('FIREBASE_STORAGE_BUCKET'),
    //     'messagingSenderId' => env('FIREBASE_MESSAGIN_SENDER_ID'),
    //     'appId' => env('FIREBASE_APP_ID'),
    //     'measurementId' => env('FIREBASE_MEASUREMENT_ID'),
    // ]
    // const firebaseConfig = {
    //     apiKey: "AIzaSyBX4oFzliZlumrqX1a9lFOQv4ZYcWJJ0UI",
    //     authDomain: "jbus-8f9bf.firebaseapp.com",
    //     databaseURL: "https://jbus-8f9bf-default-rtdb.europe-west1.firebasedatabase.app",
    //     projectId: "jbus-8f9bf",
    //     storageBucket: "jbus-8f9bf.appspot.com",
    //     messagingSenderId: "161058040222",
    //     appId: "1:161058040222:web:5c1572d4098b0fb05d4e8f",
    //     measurementId: "G-HD3L1KH7JJ"
    //   };
];

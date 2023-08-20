<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::crud('bus', 'BusCrudController');
    Route::crud('favorite-point', 'FavoritePointCrudController');
    Route::crud('o-t-p', 'OTPCrudController');
    Route::crud('passenger-profile', 'PassengerProfileCrudController');
    Route::crud('payment-transaction', 'PaymentTransactionCrudController');
    Route::crud('route', 'RouteCrudController');
    Route::crud('trip', 'TripCrudController');
    Route::crud('university', 'UniversityCrudController');
    Route::crud('user', 'UserCrudController');
}); // this should be the absolute last line of this file

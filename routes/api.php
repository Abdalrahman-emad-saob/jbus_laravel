<?php

use App\{
    Http\Controllers\Api\Auth\LoginController,
    Http\Controllers\Api\Auth\RegisterController,
    Http\Controllers\Api\Auth\SocialiteController,
    Http\Controllers\Api\ForgotPasswordController,
    Http\Controllers\Api\InterestRoutesController,
    Http\Controllers\Api\PaymentController,
    Http\Controllers\Api\PointController,
    Http\Controllers\Api\TripController,
    Http\Controllers\Api\UpdateController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Http\Controllers\WebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        //      login
        Route::post('login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
        //      register
        Route::post('register/createOTP', [RegisterController::class, 'createOTP']);
        Route::post('register/createUser', [RegisterController::class, 'createUser']);
        Route::post('update/createOTP', [UpdateController::class, 'createOTP']);
        Route::post('update/email', [UpdateController::class, 'updateEmail']);
        Route::post('update/phoneNumber', [UpdateController::class, 'updatePhoneNumber']);
        Route::post('update/updatePFP', [UpdateController::class, 'updatePFP']);

        Route::prefix('{provider}')->group(function () {
            Route::get('/', [SocialiteController::class, 'oAuthRedirect']);
            Route::get('callback', [SocialiteController::class, 'oAuthCallback']);
        })->whereIn('provider', ['facebook', 'google']);
    });
    //      Reset Password
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');

    Route::middleware('auth:sanctum')->group(function () {
        //      Favorite
        Route::post('addToFavorite', [PointController::class, 'addToFavorite']);
        Route::get('favorites', [PointController::class, 'favorites']);
        Route::get('trips-and-favorites', [PointController::class, 'tripsAndFavorites']);
        Route::delete('deleteFavorite/{id}', [PointController::class, 'deleteFavorite']);
        //      Return Point
        Route::get('point/{id}', [PointController::class, 'point']);

        //      Interest Routes
        Route::get('interestRoutes', [InterestRoutesController::class, 'interestRoutes']);
        Route::get('favoriteRoutes', [InterestRoutesController::class, 'favoriteRoutes']);
    });


    Route::middleware('auth:sanctum')->get('user', function (Request $request) {
        return response()->json(['user' => $request->user()->load(['passengerProfile'])]);
    });

    //      Payments
    Route::prefix('payment')->group(function () {
        Route::prefix('stripe')->group(function () {
            Route::post('webhook', [WebhookController::class, 'handleWebhook']);
            Route::post('create-payment-intent', [PaymentController::class, 'createPaymentIntent'])->middleware('auth:sanctum');
        });

        Route::get('pay-driver', [PaymentController::class, 'payForDriver'])
            ->middleware('auth:sanctum')
            ->name('payment.pay-driver');

        Route::get('generate-qr-code', [PaymentController::class, 'generateQRCode'])
            ->middleware(['auth:sanctum', 'checkIfDriver'])
            ->name('payment.generate-qr-code');


        Route::get('request-transfer', [PaymentController::class, 'requestTransfer'])
            ->middleware('auth:sanctum')
            ->name('payment.request-transfer');

        Route::get('transfer', [PaymentController::class, 'transfer'])
            ->middleware('auth:sanctum')
            ->name('payment.transfer');
    });

    Route::put('rate-trip', [TripController::class, 'rateTrip'])->middleware('auth:sanctum');
});



//Route::prefix('v2')->group(function () {
//    // Authentication Routes
//    Route::prefix('auth')->group(function () {
//        // Login
//        Route::post('login', [LoginController::class, 'login'])->name('auth.login');
//        Route::post('logout', [LoginController::class, 'logout'])
//            ->middleware('auth:sanctum')
//            ->name('auth.logout');
//
//        // Registration
//        Route::post('register', [RegisterController::class, 'register'])->name('auth.register');
//
//        // Update Profile
//        Route::middleware('auth:sanctum')->group(function () {
//            Route::post('profile/update', [UpdateController::class, 'updateProfile'])->name('auth.profile.update');
//        });
//
//        // Password Reset
//        Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('auth.password.forgot');
//        Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('auth.password.reset');
//
//        // Socialite
//        Route::prefix('socialite/{provider}')->where(['provider' => 'facebook|google'])->group(function () {
//            Route::get('redirect', [SocialiteController::class, 'redirectToProvider'])->name('auth.socialite.redirect');
//            Route::get('callback', [SocialiteController::class, 'handleProviderCallback'])->name('auth.socialite.callback');
//        });
//    });
//
//    // Password Reset Routes
//    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
//
//    // Authenticated Routes
//    Route::middleware('auth:sanctum')->group(function () {
//        // Favorites
//        Route::post('favorites', [FavoriteController::class, 'addToFavorites'])->name('favorites.add');
//        Route::get('favorites', [FavoriteController::class, 'getFavorites'])->name('favorites.get');
//        Route::delete('favorites/{id}', [FavoriteController::class, 'deleteFavorite'])->name('favorites.delete');
//
//        // Points
//        Route::get('points/{id}', [PointController::class, 'getPoint'])->name('points.get');
//
//        // Interest Routes
//        Route::get('interest-routes', [InterestRoutesController::class, 'getInterestRoutes'])->name('interest-routes.get');
//        Route::get('favorite-routes', [InterestRoutesController::class, 'getFavoriteRoutes'])->name('favorite-routes.get');
//
//        // User
//        Route::get('user', [UserController::class, 'getUser'])->name('user.get');
//
//        // Payments
//        Route::prefix('payments')->group(function () {
//            // Stripe
//            Route::post('stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('payments.stripe.webhook');
//            Route::post('stripe/create-payment-intent', [StripePaymentController::class, 'createPaymentIntent'])->name('payments.stripe.create-payment-intent');
//
//            // Payment Actions
//            Route::get('pay-driver', [PaymentController::class, 'payForDriver'])->name('payments.pay-driver');
//            Route::get('generate-qr-code', [PaymentController::class, 'generateQRCode'])->middleware('checkIfDriver')->name('payments.generate-qr-code');
//        });
//
//        // Rate Trip
//        Route::put('rate-trip', [TripController::class, 'rateTrip'])->name('rate-trip');
//    });
//});

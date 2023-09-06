<?php

use App\Http\Controllers\Api\Auth\SocialiteController;
use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Laravel\Cashier\Http\Controllers\WebhookController;
use App\Http\Controllers\Api\PointController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\InterestRoutesController;
use App\Http\Controllers\Api\UpdateController;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\TripController;

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
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
        //      register
        Route::post('register/createOTP', [RegisterController::class, 'createOTP']);
        Route::post('register/createUser', [RegisterController::class, 'createUser']);
        Route::post('update/createOTP', [UpdateController::class, 'createOTP']);
        Route::post('update/email', [UpdateController::class, 'updateEmail']);
        Route::post('update/phoneNumber', [UpdateController::class, 'updatePhoneNumber']);
        Route::post('update/updatePFP', [UpdateController::class, 'updatePFP']);

        Route::prefix('{provider}')->group(function () {
            Route::get('/', [SocialiteController::class, 'oAuthRedirect']);
            Route::get('/callback', [SocialiteController::class, 'oAuthCallback']);
        })->whereIn('provider', ['facebook', 'google']);
    });
    //      Reset Passowrd
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');

    Route::middleware('auth:sanctum')->group(function () {
        //      Favorite
        Route::post('addToFavorite', [PointController::class, 'addToFavorite']);
        Route::post('favorites', [PointController::class, 'favorites']);
        Route::post('tripsandFavorites', [PointController::class, 'TripsandFavorites']);
        Route::post('deleteFavorite', [PointController::class, 'deleteFavorite']);
        //      Return Point
        Route::post('point', [PointController::class, 'point']);

        //      Interest Routes
        Route::post('interestRoutes', [InterestRoutesController::class, 'interestRoutes']);
        Route::post('favoriteRoutes', [InterestRoutesController::class, 'favoriteRoutes']);
    });


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return response()->json($request->user()->load(['passengerProfile']));
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
    });

    Route::put('/rate-trip', [TripController::class, 'rateTrip'])->middleware('auth:sanctum');
});

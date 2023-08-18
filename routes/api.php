<?php

use App\Http\Controllers\Api\Auth\SocialiteController;
use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;

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
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::post('register',[RegisterController::class, 'register']);

        Route::prefix('{provider}')->group(function () {
            Route::get('/', [SocialiteController::class, 'oAuthRedirect']);
            Route::get('/callback', [SocialiteController::class, 'oAuthCallback']);
        })->whereIn('provider', ['facebook', 'google']);
    });
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
    Route::post('/returnUniversities', [ForgotPasswordController::class, 'returnUniversities']);
    Route::post('/returnUniversitiesRoutes', [ForgotPasswordController::class, 'returnUniversitiesRoutes']);
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});




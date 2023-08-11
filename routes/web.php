<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login');
});


use App\Http\Controllers\FirebaseController;

Route::get('get-firebase-data', [FirebaseController::class, 'index'])->name('firebase.index');
Route::get('update-firebase-data', [FirebaseController::class, 'nigg'])->name('firebase.index');

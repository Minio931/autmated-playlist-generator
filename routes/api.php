<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->name('auth.')->group(function () {
   Route::post('/register', [AuthController::class, 'register'])->name('register');
   Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::prefix('spotify')->name('spotify.')->group(function () {
    Route::get('/login', [SpotifyController::class, 'login'])->name('index');
    Route::get('/callback', [SpotifyController::class, 'callback'])->name('callback');
    Route::get('/me', [SpotifyController::class, 'getUserInfo'])->name('user-info');
});
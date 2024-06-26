<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecommendationsController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\SpotifyPlaylistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    Route::get('/login', [SpotifyController::class, 'login'])->name('login')->middleware('auth:sanctum');
    Route::get('/callback', [SpotifyController::class, 'callback'])->name('callback');
    Route::get('/me', [SpotifyController::class, 'getUserInfo'])->name('user-info')->middleware('auth:sanctum');
    Route::get('/user/tracks', [SpotifyController::class, 'getUserTracks'])->name('user-tracks')->middleware('auth:sanctum');
    Route::get('/user/saved-tracks', [SpotifyController::class, 'getUserSavedTracks'])->name('user-saved-tracks')->middleware('auth:sanctum');
    Route::get('/user/playlists', [SpotifyController::class, 'getUserTracksFromPlaylists'])->name('user-playlists')->middleware('auth:sanctum');
    Route::get('/user/update-artists-genres', [SpotifyController::class, 'updateArtistsGenres'])->name('update-artists-genres')->middleware('auth:sanctum');
});

Route::prefix('analytics')->name('analytics.')->group(function () {
    Route::get('/user-analytics', AnalyticsController::class)->name('user-analytics')->middleware('auth:sanctum');
});

Route::prefix('recommendations')->name('recommendations.')->group(function () {
    Route::get('/base-recommendations', [RecommendationsController::class, 'getRecommendations'])->name('recommendations')->middleware('auth:sanctum');
});

Route::prefix('playlists')->name('playlists.')->group(function () {
    Route::get('/create-playlist-for-driving', [SpotifyPlaylistController::class, 'createPlaylistForDriving'])->name('create-playlist-for-driving')->middleware('auth:sanctum');
    Route::get('/create-playlist-for-working', [SpotifyPlaylistController::class, 'createPlaylistForWorking'])->name('create-playlist-for-working')->middleware('auth:sanctum');
    Route::get('/create-playlist-for-reading', [SpotifyPlaylistController::class, 'createPlaylistForReading'])->name('create-playlist-for-reading')->middleware('auth:sanctum');
    Route::get('/create-playlist-for-workout', [SpotifyPlaylistController::class, 'createPlaylistForWorkout'])->name('create-playlist-for-workout')->middleware('auth:sanctum');
    Route::get('/create-playlist-from-recommendations', [SpotifyPlaylistController::class, 'createPlaylistFromRecommendations'])->name('create-playlist-from-recommendations')->middleware('auth:sanctum');
});

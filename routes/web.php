<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\LoginController;

Route::get('login/twitch', [LoginController::class, 'redirectToProvider'])->name('login');
Route::get('login/twitch/callback', [LoginController::class, 'handleProviderCallback']);

Route::middleware(['auth'])->group(function () {
    Route::get('logout/twitch', [LoginController::class, 'handleLogout'])->name('logout');
    Route::get('/settings', SettingsController::class)->name('settings');
});

Route::get('/', HomeController::class)->name('home');
Route::get('/about', AboutController::class)->name('about');
Route::get('/preview', PreviewController::class)->name('preview');
Route::get('/{stream}', StreamController::class)->name('stream');

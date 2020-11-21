<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('login/twitch', [LoginController::class, 'redirectToProvider'])->name('login.twitch');
Route::get('login/twitch/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/{stream}', function ($stream) {
    return view('stream', ['stream' => strtolower($stream)]);
})->name('stream');

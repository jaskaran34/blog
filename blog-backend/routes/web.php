<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\GoogleController;
use \App\Http\Middleware\cors;


use Laravel\Socialite\Facades\Socialite;


Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login_google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    return view('welcome');
});


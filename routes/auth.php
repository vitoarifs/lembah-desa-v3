<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Middleware\CheckBukaPintuLogin;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {

    // Login hanya dapat diakses melalui /gerbang-admin
    Volt::route('login', 'pages.auth.login')
        ->name('login')
        ->middleware(CheckBukaPintuLogin::class);

    // Forgot Password
    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    // Reset Password
    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});


Route::middleware('auth')->group(function () {

    // Email Verification
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    // Confirm Password
    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Akses ke halaman login melalui /gerbang-admin

Route::get('/gerbang-admin', function () {
    // Berikan izin akses ke form login melalui session
    session(['buka_pintu_login' => true]);
    
    // Alihkan langsung ke halaman login asli
    return redirect()->route('login');
});


// Rute Publik (Akses Tanpa Login)
Route::get('/artikel', \App\Livewire\PublicArticleIndex::class)->name('artikel.index');
Route::get('/artikel/{slug}', \App\Livewire\PublicArticleShow::class)->name('artikel.show');

// Rute Backend Manajemen (Harus Login + Punya Role Admin / Manager)
Route::middleware(['auth', 'role:admin,content_manager'])->group(function () {
    Route::get('/dashboard/artikel', \App\Livewire\ManageArticles::class)->name('artikel.manage');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');
});



Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

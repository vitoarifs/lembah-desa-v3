<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Spatie\ResponseCache\Middlewares\CacheResponse;

// Akses ke halaman login melalui /gerbang-admin

Route::get('/gerbang-admin', function () {
    session()->put('buka_pintu_login', true);

    return redirect()->route('login');
})->name('gerbang-admin');


// Rute Publik yang di-cache
Route::middleware(CacheResponse::using(60 * 24))->group(function () {

    Route::get('/', \App\Livewire\Guest\Home\Index::class)
        ->name('home.index');

    Route::get('/kuliner', \App\Livewire\Guest\Kuliner\Index::class)
        ->name('kuliner.index');

    Route::get(
        '/kuliner/{category:slug}',
        \App\Livewire\Guest\Kuliner\KulinerKategori\Index::class
    )->name('kuliner.category.index');

    Route::get(
        '/kuliner/{category:slug}/{menu:slug}',
        \App\Livewire\Guest\Kuliner\KulinerKategori\KulinerDetail\Index::class
    )->name('kuliner.category.detail.index');

    Route::get('/event', \App\Livewire\Guest\Event\Index::class)
        ->name('event.index');
});


// Tidak di-response-cache karena mempunyai form interaktif
Route::get('/kontak-kami', \App\Livewire\Guest\KontakKami\Index::class)->name('kontak-kami.index');

// -----------------------------------------------------------------------------------------------------------



Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/identitas-website', App\Livewire\Admin\SiteIdentity\Index::class)->name('identitas-website.index');

    Route::get('/kelola-content-manager', App\Livewire\Admin\Account\Index::class)->name('kelola-content-manager.index');
});


// Form Register hanya untuk Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');
});


// -----------------------------------------------------------------------------------------------------------


Route::middleware(['auth', 'role:admin,content_manager'])->prefix('admin')->name('admin.')->group(function () {

    // Rute untuk Dashboard
    Route::get('/dashboard', App\Livewire\Admin\Dashboard::class)->name('dashboard');

    // Rute untuk manajemen kuliner
    Route::get('/kuliner/kategori', App\Livewire\Admin\KulinerCategoryIndex::class)->name('kuliner.kategori.index');
    Route::get('/kuliner/menu', App\Livewire\Admin\KulinerMenuIndex::class)->name('kuliner.menu.index');

    // Rute untuk manajemen event
    Route::get('/event', App\Livewire\Admin\Event\Index::class)->name('event.index');

    Route::get('/pesan-masuk', App\Livewire\Admin\ContactMessages\Index::class)->name('contact-messages.index');
});


// -----------------------------------------------------------------------------------------------------------




Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

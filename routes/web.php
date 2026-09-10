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

Route::get('/', \App\Livewire\Guest\Home\Index::class)->name('home.index');

Route::get('/kuliner', \App\Livewire\Guest\Kuliner\Index::class)->name('kuliner.index');
Route::get('/kuliner/{kategori_slug}', \App\Livewire\Guest\Kuliner\KulinerKategori\Index::class)->name('kuliner.category.index');
Route::get('/kuliner/{kategori_slug}/{menu_slug}', \App\Livewire\Guest\Kuliner\KulinerKategori\KulinerDetail\Index::class)->name('kuliner.category.detail.index');

Route::get('/event', \App\Livewire\Guest\Event\Index::class)->name('event.index');
Route::get('/kontak-kami', \App\Livewire\Guest\KontakKami\Index::class)->name('kontak-kami.index');


// Rute untuk menampilkan pesan kontak di halaman admin, HAPUS ROUTE INI DI MASA DEPAN JIKA SUDAH TIDAK DIPERLUKAN
Route::get('/emails', \App\Livewire\Mail\ContactMessages::class)->name('emails');



// Rute Backend Manajemen (Harus Login + Punya Role Admin / Manager)
Route::middleware(['auth', 'role:admin,content_manager'])->group(function () {
    //
});

Route::middleware(['auth', 'role:admin,content_manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/kuliner/kategori', App\Livewire\Admin\KulinerCategoryIndex::class)->name('kuliner.kategori.index');
    Route::get('/kuliner/kategori/create', App\Livewire\Admin\KulinerCategoryCreate::class)->name('kuliner.kategori.create');
    Route::get('/kuliner/kategori/{category}/edit', App\Livewire\Admin\KulinerCategoryEdit::class)->name('kuliner.kategori.edit');

    // Route::get('/kuliner/kategori/{category}/delete', App\Livewire\Admin\KulinerCategoryDelete::class)->name('kuliner.kategori.delete');

    Route::get('/kuliner/menu', App\Livewire\Admin\KulinerMenuIndex::class)->name('kuliner.menu.index');
    Route::get('/kuliner/menu/create', App\Livewire\Admin\KulinerMenuCreate::class)->name('kuliner.menu.create');
    Route::get('/kuliner/menu/{menu}/edit', App\Livewire\Admin\KulinerMenuEdit::class)->name('kuliner.menu.edit');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');
});



// Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

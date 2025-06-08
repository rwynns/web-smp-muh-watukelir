<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PrestasiController;

Route::get('/', function () {
    return view('index');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/sarana-dan-prasarana', function () {
    return view('sarana-prasarana');
});

Route::get('/ekstrakurikuler', function () {
    return view('ekstrakurikuler');
});

Route::get('/prestasi', function () {
    return view('prestasi');
});

// Public berita routes
Route::get('/berita/{category?}', [BeritaController::class, 'publicIndex'])->name('berita.index');
Route::get('/berita/{category}/{slug}', [BeritaController::class, 'publicShow'])->name('berita.show');

// Route khusus untuk backward compatibility
Route::get('/berita-sekolah', [BeritaController::class, 'publicIndex'])->defaults('category', 'berita_sekolah')->name('berita.sekolah');


// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Berita routes
    Route::get('berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    // Prestasi routes
    Route::resource('prestasi', PrestasiController::class);
    Route::post('prestasi/upload-image', [PrestasiController::class, 'uploadImage'])->name('prestasi.upload-image');
    Route::delete('prestasi/cleanup-images', [PrestasiController::class, 'cleanupUnusedImages'])->name('prestasi.cleanup-images');
});

// Login routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.post');
});

// Logout route (auth only)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

// Public prestasi routes
Route::get('/prestasi', [PrestasiController::class, 'publicIndex'])->name('prestasi.index');
Route::get('/prestasi/{slug}', [PrestasiController::class, 'publicShow'])->name('prestasi.show');

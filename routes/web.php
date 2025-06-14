<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SaranaPrasaranaController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('index');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/ekstrakurikuler', function () {
    return view('ekstrakurikuler');
});

Route::get('/prestasi', function () {
    return view('prestasi');
});

Route::get('/ppdb', function () {
    return view('ppdb');
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

    // PPDB Routes
    Route::get('/ppdb', [PpdbController::class, 'adminIndex'])->name('ppdb.index');
    Route::get('/ppdb/{ppdb}', [PpdbController::class, 'adminShow'])->name('ppdb.show');
    Route::delete('/ppdb/{ppdb}', [PpdbController::class, 'adminDestroy'])->name('ppdb.destroy');

    // Galeri routes
    Route::resource('galeri', GaleriController::class);
    Route::resource('ekstrakurikuler', EkstrakurikulerController::class);
    Route::resource('sarana-prasarana', SaranaPrasaranaController::class)->parameters([
        'sarana-prasarana' => 'saranaPrasarana'
    ]);
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

// PPDB Routes
Route::get('/ppdb', [App\Http\Controllers\PPDBController::class, 'index'])->name('ppdb.index');
Route::post('/ppdb/store', [App\Http\Controllers\PPDBController::class, 'store'])->name('ppdb.store');
Route::get('/ppdb/download-template', [App\Http\Controllers\PPDBController::class, 'downloadTemplate'])->name('ppdb.download-template');

// Frontend Galeri Route
Route::get('/galeri', [GaleriController::class, 'frontendGaleri'])->name('galeri');

// Frontend Ekstrakurikuler Routes
Route::get('/ekstrakurikuler', [App\Http\Controllers\EkstrakurikulerController::class, 'frontendIndex'])->name('ekstrakurikuler.index');
Route::get('/ekstrakurikuler/{id}', [App\Http\Controllers\EkstrakurikulerController::class, 'frontendShow'])->name('ekstrakurikuler.show');

// Frontend Sarana Prasarana Routes
Route::get('/sarana-prasarana', [SaranaPrasaranaController::class, 'frontendIndex'])->name('sarana-prasarana.index');
Route::get('/sarana-prasarana/{id}', [SaranaPrasaranaController::class, 'frontendShow'])->name('sarana-prasarana.show');

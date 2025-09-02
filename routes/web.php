<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MapSettingController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\MapController;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/tentang', [FrontendController::class, 'tentang'])->name('frontend.tentang');
Route::get('/berita', [FrontendController::class, 'berita'])->name('frontend.berita');
Route::get('/berita/{id}', [FrontendController::class, 'detailBerita'])->name('frontend.berita.detail');
Route::get('/galery', [FrontendController::class, 'gallery'])->name('frontend.galery');
Route::get('/kontak', [ContactController::class, 'create'])->name('kontak.create');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// Redirect setelah login
Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
    }
    return redirect('/');
})->middleware('auth')->name('dashboard');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Tentang
        Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('/about/update', [AboutController::class, 'update'])->name('about.update');

        // Berita
        Route::resource('news', NewsController::class);

        // Gallery
        Route::resource('gallery', GalleryController::class);

        // Kontak Backend
        Route::get('/contact', [ContactMessageController::class, 'index'])->name('contact.index');
        Route::get('/contact/{id}', [ContactMessageController::class, 'show'])->name('contact.show');
        Route::delete('/contact/{id}', [ContactMessageController::class, 'destroy'])->name('contact.destroy');

        Route::get('/map/edit', [MapController::class, 'edit'])->name('map.edit');
        Route::put('/map/update', [MapController::class, 'update'])->name('map.update');
    });

require __DIR__ . '/auth.php';

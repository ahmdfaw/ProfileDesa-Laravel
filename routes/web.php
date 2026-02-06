<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OfficialController as AdminOfficialController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/layanan', [ServiceController::class, 'index'])->name('services.index');
Route::get('/layanan/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('news', AdminNewsController::class);
        Route::resource('officials', AdminOfficialController::class);
        Route::resource('galleries', AdminGalleryController::class);
        Route::resource('services', AdminServiceController::class);

        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
        Route::patch('/contacts/{contact}/mark-read', [AdminContactController::class, 'markAsRead'])->name('contacts.mark-read');

        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    });
});

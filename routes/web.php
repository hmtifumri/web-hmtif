<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\PeriodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('profil', 'profile')->name('profil');
Route::get('kepengurusan/{periode}', [HomeController::class, 'kepengurusan'])->name('kepengurusan');
Route::view('galeri', 'galeri')->name('galeri');
Route::view('artikel', 'artikel')->name('artikel');

Route::get('kepengurusan/{periode}/{divisi}', [DivisiController::class, 'show'])->name('divisi.show');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user/edit/{id}', [DashboardController::class, 'edit'])->name('user.edit');

    Route::get('/dashboard/periode/{periode}', [PeriodeController::class, 'detailPeriode'])->name('detail.periode');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard/periode', [PeriodeController::class, 'index'])->name('periode.dashboard');
        Route::get('/dashboard/kepengurusan', [DashboardController::class, 'kepengurusan'])->name('kepengurusan.dashboard');
        Route::get('/dashboard/pendaftaran', [DashboardController::class, 'pendaftaran'])->name('dashboard.pendaftaran');
        Route::get('/dashboard/pengaturan-pendaftaran', [DashboardController::class, 'pengaturanPendaftaran'])->name('pengaturan.pendaftaran');
    });
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::view('profile', 'dashboard/profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

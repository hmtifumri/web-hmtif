<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('profil', 'profile')->name('profil');
Route::view('kepengurusan', 'kepengurusan')->name('kepengurusan');
Route::view('galeri', 'galeri')->name('galeri');
Route::view('artikel', 'artikel')->name('artikel');

Route::view('dashboard', 'dashboard/dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'dashboard/profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProkerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('profil', 'profile')->name('profil');
Route::get('kepengurusan/{periode}', [HomeController::class, 'kepengurusan'])->name('kepengurusan');
Route::get('galeri', [GalleryController::class, 'index'])->name('galeri');
Route::get('/artikel', [HomeController::class, 'artikel'])->name('artikel');
Route::get('/artikel/{slug}', [HomeController::class, 'showArticle'])->name('showArticle');
Route::get('/artikel/kategori/{slug}', [HomeController::class, 'artikelByKategori'])->name('artikelByKategori');

Route::get('/kepengurusan/{periode}/{divisi}', [DivisiController::class, 'show'])->name('divisi.show');
Route::get('/kepengurusan/{periode}/{divisi}/proker/{slug}', [ProkerController::class, 'show'])->name('detail.proker');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user/edit/{id}', [DashboardController::class, 'edit'])->name('user.edit');
    Route::get('/dashboard/proker/{periode}', [ProkerController::class, 'index'])->name('dashboard.proker');
    Route::get('/dashboard/proker/{periode}/tambah', [ProkerController::class, 'create'])->name('tambah.proker');
    Route::get('/dashboard/proker/{periode}/{slug}/edit', [ProkerController::class, 'edit'])->name('edit.proker');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard/periode', [PeriodeController::class, 'index'])->name('periode.dashboard');
        Route::get('/dashboard/periode/{periode}', [PeriodeController::class, 'detailPeriode'])->name('detail.periode');
        
        Route::get('/dashboard/pendaftaran', [DashboardController::class, 'pendaftaran'])->name('dashboard.pendaftaran');
        Route::get('/dashboard/pengaturan-pendaftaran', [DashboardController::class, 'pengaturanPendaftaran'])->name('pengaturan.pendaftaran');
        
        Route::get('/dashboard/periode/{periode}/pembina/create', [PembinaController::class, 'create'])->name('pembina.create');
        Route::get('/dashboard/periode/{periode}/pembina/{id}/edit', [PembinaController::class, 'edit'])->name('pembina.edit');
    });
    
    // khusus admin dan ksb
    Route::get('/dashboard/kepengurusan', [DashboardController::class, 'kepengurusan'])->name('kepengurusan.dashboard');
    
    // khusus kadiv dan admin
    Route::get('/dashboard/periode/{periode}/{divisi}/edit', [DivisiController::class, 'editDivisi'])->name('edit.divisi');

    // khusus admin dan kominfo
    Route::middleware(['adminOrKominfo'])->group(function () {
        Route::get('/dashboard/artikel', [ArticleController::class, 'index'])->name('dashboard.artikel');
        Route::get('/dashboard/artikel/tambah', [ArticleController::class, 'create'])->name('dashboard.artikel.tambah');
        Route::get('/dashboard/artikel/edit/{slug}', [ArticleController::class, 'edit'])->name('dashboard.artikel.edit');
        Route::get('/dashboard/kategori', [CategoriesController::class, 'index'])->name('dashboard.kategori');
        Route::get('/dashboard/banner', [DashboardController::class, 'banner'])->name('dashboard.banner');
    });
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::view('profile', 'dashboard/profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

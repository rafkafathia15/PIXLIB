<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUsrController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/tentang', fn () => view('tentang'))->name('tentang');

/*
|--------------------------------------------------------------------------
| Dashboard USER / PEMINJAM
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardUsrController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Koleksi Buku (USER)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/koleksi', [BukuController::class, 'koleksi'])
        ->name('koleksi.buku');

    Route::get('/buku/{id}', [BukuController::class, 'show'])
        ->name('buku.detail');

    Route::post('/buku/{id}/ulasan', [UlasanController::class, 'store'])
        ->name('ulasan.store');

    Route::get('/riwayat-buku', [PeminjamanController::class, 'riwayat'])
        ->name('riwayat.buku');

    // =========================
    // CETAK BUKTI PER BUKU (USER)
    // =========================
    Route::get('/riwayat/cetak/{id}', [PeminjamanController::class, 'cetakPerBuku'])
        ->name('riwayat.cetak.perbuku');

    // =========================
    // PINJAM BUKU
    // =========================
    Route::get('/pinjam/{id}', [PeminjamanController::class, 'create'])
        ->name('pinjam.create');

    Route::post('/pinjam/{id}', [PeminjamanController::class, 'store'])
        ->name('pinjam.store');

    // =========================
    // CETAK BUKTI PEMINJAMAN (LAMA - OPTIONAL)
    // =========================
    Route::get('/pinjam/cetak/{peminjaman}', [PeminjamanController::class, 'cetak'])
        ->name('pinjam.cetak');

    // =========================
    // FAVORIT
    // =========================
    Route::post('/buku/{buku}/favorite', [FavoriteController::class, 'toggle'])
        ->name('buku.favorite');

    Route::get('/favorit', [FavoriteController::class, 'index'])
        ->name('favorit.index');
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| PETUGAS AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/', [PetugasController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/peminjaman', [PetugasController::class, 'peminjaman'])
            ->name('peminjaman');

        Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])
            ->name('peminjaman.update');

        Route::get('/riwayat', [PetugasController::class, 'riwayat'])
            ->name('riwayat');

        Route::get('/peminjaman/{id}/pdf', [PetugasController::class, 'cetakPdf'])
            ->name('peminjaman.pdf');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/manajemen-buku', [BukuController::class, 'index'])
            ->name('manajemen-buku');

        Route::get('/petugas', [PetugasController::class, 'index'])
            ->name('petugas.index');
        Route::post('/petugas', [PetugasController::class, 'store'])
            ->name('petugas.store');
        Route::put('/petugas/{id}', [PetugasController::class, 'update'])
            ->name('petugas.update');
        Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])
            ->name('petugas.destroy');

        Route::get('/buku', [BukuController::class, 'index'])
            ->name('buku.index');
        Route::get('/buku/tambah', [BukuController::class, 'create'])
            ->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])
            ->name('buku.store');
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])
            ->name('buku.edit');
        Route::put('/buku/{id}', [BukuController::class, 'update'])
            ->name('buku.update');
        Route::delete('/buku/{id}', [BukuController::class, 'destroy'])
            ->name('buku.destroy');

        Route::resource('kategori', KategoriController::class);

        Route::get('/ulasan', [UlasanController::class, 'index'])
            ->name('ulasan');

        Route::get('/peminjam', [AdminController::class, 'peminjam'])
            ->name('peminjam.index');
        Route::delete('/peminjam/{id}', [AdminController::class, 'destroyPeminjam'])
            ->name('peminjam.destroy');

        Route::get('/riwayat', [AdminController::class, 'riwayat'])
            ->name('riwayat');

        Route::get('/peminjaman/{id}/pdf', [AdminController::class, 'cetakPdf'])
            ->name('peminjaman.pdf');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
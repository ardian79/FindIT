<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangTemuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KlaimController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanKehilanganController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
});

Route::prefix('mahasiswa')->name('mahasiswa.')->middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/laporan', [LaporanKehilanganController::class, 'indexMahasiswa'])->name('laporan.index');
    Route::post('/laporan', [LaporanKehilanganController::class, 'store'])->name('laporan.store');
    Route::put('/laporan/{laporanKehilangan}', [LaporanKehilanganController::class, 'update'])->name('laporan.update');
    Route::patch('/laporan/{laporanKehilangan}/ditemukan', [LaporanKehilanganController::class, 'tandaiDitemukan'])->name('laporan.ditemukan');
    Route::delete('/laporan/{laporanKehilangan}', [LaporanKehilanganController::class, 'destroyMahasiswa'])->name('laporan.destroy');

    Route::get('/klaim', [KlaimController::class, 'indexMahasiswa'])->name('klaim.index');
    Route::post('/klaim/{barangTemuan}', [KlaimController::class, 'store'])->name('klaim.store');
});

Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('barang-temuan', BarangTemuanController::class)->except(['show']);

    Route::get('/laporan-kehilangan', [LaporanKehilanganController::class, 'indexPetugas'])->name('laporan-kehilangan.index');
    Route::patch('/laporan-kehilangan/{laporanKehilangan}/status', [LaporanKehilanganController::class, 'updateStatus'])->name('laporan-kehilangan.status');
    Route::delete('/laporan-kehilangan/{laporanKehilangan}', [LaporanKehilanganController::class, 'destroyPetugas'])->name('laporan-kehilangan.destroy');

    Route::get('/verifikasi-klaim', [KlaimController::class, 'indexPetugas'])->name('verifikasi-klaim.index');
    Route::get('/verifikasi-klaim/{klaim}', [KlaimController::class, 'show'])->name('verifikasi-klaim.show');
    Route::patch('/verifikasi-klaim/{klaim}/setujui', [KlaimController::class, 'setujui'])->name('verifikasi-klaim.setujui');
    Route::patch('/verifikasi-klaim/{klaim}/tolak', [KlaimController::class, 'tolak'])->name('verifikasi-klaim.tolak');
    Route::patch('/verifikasi-klaim/{klaim}/selesai', [KlaimController::class, 'selesai'])->name('verifikasi-klaim.selesai');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::patch('/pengguna/{user}/toggle-status', [PenggunaController::class, 'toggleStatus'])->name('pengguna.toggle-status');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
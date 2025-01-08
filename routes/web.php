<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('mahasiswa.dashboard')->with('user_type', 'mahasiswa');
})->middleware(['web'])->name('dashboard');

Route::get('dosen/login', function () {
    return view('auth.login');
})->name('dosen.login');

Route::get('dosen/register', function () {
    return view('auth.register');
})->name('dosen.register');

Route::middleware('dosen')->prefix('dosen')->group(function () {
    Route::get('dashboard', function () {
        return view('dosen.dashboard')->with('user_type', 'dosen');
    })->name('dosen.dashboard');

    Route::get('jadwal', [JadwalController::class, 'index'])
        ->name('jadwal.dosen.index');
    Route::get('jadwal/create', [JadwalController::class, 'create'])
        ->name('jadwal.dosen.create');
    Route::post('jadwal', [JadwalController::class, 'store']) // Make sure this line is correct
        ->name('jadwal.dosen.store');
        Route::delete('jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('jadwal.dosen.destroy');
        Route::get('jadwal/{jadwal}/edit', [JadwalController::class, 'edit'])->name('jadwal.dosen.edit');
        Route::put('jadwal/{jadwal}', [JadwalController::class, 'update'])->name('jadwal.dosen.update');


        Route::get('reservasi/{id}/form', [ReservasiController::class, 'showReservasiForm'])->name('reservasi.form');
        Route::post('reservasi/{id}', [ReservasiController::class, 'storeReservasi'])->name('reservasi.dosen');

    Route::get('reservasi', [ReservasiController::class, 'indexDosen'])
        ->name('reservasi.dosen.index');

    Route::get('reservasi/{reservasi_id}', [ReservasiController::class, 'detailReservasiDosen'])
        ->name('reservasi.detail.dosen');

    Route::post('reservasi/{reservasi_id}/complete', [ReservasiController::class, 'selesaiReservasi'])
        ->name('reservasi.dosen.complete');

    Route::get('riwayat', [RiwayatController::class, 'index'])
        ->name('riwayat.dosen.index');

    Route::get('riwayat/create', [RiwayatController::class, 'showCompletedReservasi'])
        ->name('riwayat.dosen.index.finished');

    Route::get('riwayat/create/{reservasi_id}', [RiwayatController::class, 'create'])
        ->name('riwayat.dosen.create');

    Route::post('riwayat/create/{reservasi_id}/save', [RiwayatController::class, 'store'])
        ->name('riwayat.dosen.create.save');

    Route::get('riwayat/{riwayat_id}', [RiwayatController::class, 'show'])
        ->name('riwayat.detail.dosen');

    Route::post('riwayat/{riwayat_id}/update', [RiwayatController::class, 'update'])
        ->name('riwayat.dosen.update');

    Route::post('dosen/logout', [DosenController::class, 'destroy'])
        ->name('dosen.logout');
});

Route::get('riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

require __DIR__ . '/auth.php';

// Tambahkan ini ke routes/web.php
Route::post('/telegram/webhook', [TelegramController::class, 'handleWebhook']);

Route::middleware('auth')->prefix('mahasiswa')->group(function () {
    Route::get('reservasi/{dosen_id}', [ReservasiController::class, 'reservasiDosen'])->name('reservasi.form');
    Route::post('reservasi/{dosen_id}/create', [ReservasiController::class, 'createReservasi'])->name('reservasi.create'); // Tambahkan ini
    Route::get('reservasi/list', [ReservasiController::class, 'listReservasi'])->name('reservasi.list');
    Route::get('reservasi/{id_reservasi}/detail', [ReservasiController::class, 'detailReservasi'])->name('reservasi.detail');
    Route::post('reservasi/{id_reservasi}/update', [ReservasiController::class, 'updateReservasi'])->name('reservasi.update');
    Route::post('reservasi/{id_reservasi}/delete', [ReservasiController::class, 'deleteReservasi'])->name('reservasi.delete');
    Route::get('mahasiswa/reservasi/list', [ReservasiController::class, 'listReservasi'])->name('reservasi.list');
    Route::get('/reservasi', [ReservasiController::class, 'listReservasi'])->name('mahasiswa.reservasi');
    Route::post('reservasi/list/{id}/update', [ReservasiController::class, 'updateReservasi'])->name('reservasi.update');

    // Menampilkan form reset password
    Route::post('mahasiswa/password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');


// Proses reset password
Route::post('mahasiswa/password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

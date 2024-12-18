<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ReservasiController;
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

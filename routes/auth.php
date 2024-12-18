<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\DosenController; // Updated controller name
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\RiwayatController; // Updated controller name
use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::post('login/dosen', [DosenController::class, 'login']) // Changed to dosen
        ->name('dosen.login');

    Route::post('register/dosen', [DosenController::class, 'register']) // Changed to dosen
        ->name('dosen.register');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('reservasi', [DosenController::class, 'index']) // Changed to dosen
        ->name('reservasi.index');

    Route::get('reservasi/list', [ReservasiController::class, 'listReservasi'])
        ->name('reservasi.list');

    Route::get('reservasi/{id_dosen}', [ReservasiController::class, 'reservasiDosen']) // Changed to id_dosen
        ->name('reservasi');

    Route::post('reservasi/{id_dosen}/create', [ReservasiController::class, 'createReservasi']) // Changed to id_dosen
        ->name('reservasi.dosen');

    Route::get('reservasi/list/{id_reservasi}', [ReservasiController::class, 'detailReservasi'])
        ->name('reservasi.detail');

    Route::post('reservasi/list/{id_reservasi}/update', [ReservasiController::class, 'updateReservasi']);

    Route::post('reservasi/list/{id_reservasi}/delete', [ReservasiController::class, 'deleteReservasi']);

    Route::get('riwayat', [RiwayatController::class, 'indexMahasiswa']) // Changed to riwayat
        ->name('riwayat.index');

    Route::get('riwayat/{id_riwayat}', [RiwayatController::class, 'showMahasiswaRiwayat']) // Changed to riwayat
        ->name('riwayat.detail');
});

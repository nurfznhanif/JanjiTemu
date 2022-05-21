<?php

use App\Http\Controllers\DokterController;
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
    return view('pasien.dashboard')->with('user_type', 'pasien');
})->middleware(['web'])->name('dashboard');

Route::get('/dokter/dashboard', function () {
    return view('dokter.dashboard')->with('user_type', 'dokter');
})->middleware(['dokter'])->name('dokter.dashboard');

Route::post('dokter/logout', [DokterController::class, 'destroy'])->middleware('dokter')
    ->name('dokter.logout');

require __DIR__ . '/auth.php';
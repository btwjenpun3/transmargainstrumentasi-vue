<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return inertia('Home/Index');
})->name('home')->middleware('auth');

Route::get('/login', [AuthController::class, 'create'])->name('login');

Route::post('/login', [AuthController::class, 'store'])->name('login.store');

Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('laporan', LaporanController::class)->middleware('auth');

Route::post('/laporan/{laporan}/approve', [LaporanController::class, 'approve'])->name('laporan.approve')->middleware('auth');

Route::post('/laporan/{laporan}/reject', [LaporanController::class, 'reject'])->name('laporan.reject')->middleware('auth');

Route::resource('barang', MasterBarangController::class)->middleware('auth');

Route::resource('user', UserController::class)->middleware('auth');

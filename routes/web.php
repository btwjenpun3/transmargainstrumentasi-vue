<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasterBarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return inertia('Home/Index');
})->name('home');

Route::resource('laporan', LaporanController::class);

Route::resource('barang', MasterBarangController::class);

<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return inertia('Home/Index');
})->name('home');

Route::resource('laporan', LaporanController::class);

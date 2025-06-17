<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dosen
Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
Route::get('/dosen/export/pdf/{id}', [DosenController::class, 'exportPdfPerData'])->name('dosen.exportPdfPerData');


// Mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
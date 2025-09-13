<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\RuanganController;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Ruangan;

Route::get('/mahasiswa', [MahasiswaController::class,'index']);
Route::post('/mahasiswa', [MahasiswaController::class,'store']);

Route::get('/matakuliah', [MatkulController::class,'index']);
Route::post('/matakuliah', [MatkulController::class,'store']);

Route::get('/ruangan', [RuanganController::class,'index']);
Route::post('/ruangan', [RuanganController::class,'store']);

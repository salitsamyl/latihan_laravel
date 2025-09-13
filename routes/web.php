<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Models\Mahasiswa;

Route::get('/mahasiswa', [MahasiswaController::class,'index']);
Route::post('/mahasiswa', [MahasiswaController::class,'store']);

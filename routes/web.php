<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/h', function () {
    return ('Hello Worldkk');
});

Route::get('/h', function () {
    return ('test Worldkk');
});
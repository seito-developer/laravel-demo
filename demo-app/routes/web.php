<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/home', 'auth.home')->middleware('auth'); // ホーム画面の表示処理
<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    $username = 'Taro';
    $is_admin = False;
    $skills = ['PHP', 'HTML', 'JS'];

    return view('profile', [
        'name' => $username,
        'is_admin' => $is_admin,
        'skills' => $skills
    ]);
});

Route::get('/posts', [PostController::class, 'index']);
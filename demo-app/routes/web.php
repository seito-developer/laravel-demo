<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/home', 'auth.home')->middleware('auth'); // ホーム画面の表示処理

Route::middleware('auth')->group(function () {

    // タスクのCRUD (一覧、作成、保存、詳細、編集、更新、削除)
    Route::resource('projects', ProjectController::class);
    Route::resource('todos', TodoController::class);

    // TODO: ここにダッシュボードのルートも追加する (例: Route::get('/dashboard', ...))
    // とりあえずトップページをタスク一覧にしておく
    Route::get('/dashboard', [TodoController::class, 'index'])->name('dashboard');
});

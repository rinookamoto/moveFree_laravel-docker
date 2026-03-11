<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// トップページ
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// ログインが必要な機能
Route::middleware(['auth', 'verified'])->group(function () {
    // マイページ
    Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // 編集画面
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    // 更新処理
    Route::patch('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    // 削除処理
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    // プロフィール管理
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. 誰でも見れる詳細画面
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';
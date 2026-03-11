<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;   // ログイン処理
use App\Http\Controllers\Auth\ConfirmablePasswordController;    // パスワード確認
use App\Http\Controllers\Auth\EmailVerificationNotificationController; // メール認証通知送信
use App\Http\Controllers\Auth\EmailVerificationPromptController; // メール認証画面
use App\Http\Controllers\Auth\NewPasswordController; // 新しいパスワード設定
use App\Http\Controllers\Auth\PasswordController; // パスワード更新
use App\Http\Controllers\Auth\PasswordResetLinkController; // パスワードリセットリンク送信
use App\Http\Controllers\Auth\RegisteredUserController; // ユーザー登録
use App\Http\Controllers\Auth\VerifyEmailController; // メール認証処理
use Illuminate\Support\Facades\Route;

// 未ログインユーザー
Route::middleware('guest')->group(function () {

    // ユーザー登録画面
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // ユーザー登録処理
    Route::post('register', [RegisteredUserController::class, 'store']);

     // ログイン画面
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // ログイン処理
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // パスワードリセット（メール送信）
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    // パスワードリセットリンク送信
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // パスワード再設定画面
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    // 新しいパスワード保存
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// ログインユーザー
Route::middleware('auth')->group(function () {

    // メール認証案内
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    // メール認証処理
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1']) // 不正アクセス防止 + 回数制限
        ->name('verification.verify');

    // メール認証リンク再送信
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // パスワード確認
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    // パスワード確認処理
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // パスワード更新
    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');

    // ログアウト処理
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\ConsultationsController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ランディングページ
Route::get('/', function () {
    return view('landing');
});

Route::get('/consultations', [ConsultationsController::class, 'index'])->name('consultations.index');
Route::get('/consultations/choose-expert', [ConsultationsController::class, 'chooseExpert'])->name('consultations.choose-expert');
Route::get('/consultations/choose-category', [ConsultationsController::class, 'chooseCategory'])->name('consultations.choose-category');

// チャット関連
Route::get('/chats', [ChatsController::class, 'index'])->name('chats.index');
Route::get('/chats/talk', function () {
    return view('chats.talk');
});
Route::post('/chats/talk', [ChatsController::class, 'talk'])->name('chats.talk');
Route::get('/chats/form', [ChatsController::class, 'form'])->name('chats.form'); // フォーム付きのチャット画面
Route::post('/chats/store', [ChatsController::class, 'store'])->name('chats.store');

// 認証が必要なルート（グループ化）
Route::middleware(['auth', 'verified'])->group(function () {

    // ダッシュボード（タスク一覧を表示）
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');

    // タスク一覧取得（API用）
    Route::get('/tasks', [TaskController::class, 'getTasks'])->name('tasks.get');

    // タスクの作成
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // タスクのステータス更新（ドラッグ＆ドロップ対応）
    Route::post('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    // タスクの削除
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // タスクの編集
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    // タスクの更新
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

    // プロフィール管理
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/credits/purchase', [CreditController::class, 'purchaseCredits'])->name('credits.purchase');
});

// ユーザーのクレジット情報を取得するAPI
Route::get('/user/credits', [TaskController::class, 'getCredits'])->name('user.credits');

// ログアウト処理
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate(); // セッションを無効化
    session()->regenerateToken(); // CSRFトークンを再生成
    return redirect('/'); // ログアウト後のリダイレクト先
})->name('logout');

// テスト用
Route::get('/test', function () {
    return view('test');
})->middleware(['auth'])->name('test');

// 認証関連ルートの読み込み
require __DIR__.'/auth.php';

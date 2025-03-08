<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\ConsultationsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ランディングページ
Route::get('/', function () {
    return view('landing');
});

// 相談窓口ページ
Route::get('/consultations', [ConsultationsController::class, 'index'])->name('consultations.index');

// 業務内容を選んで相談する
Route::get('/consultations/choose-category', [ConsultationsController::class, 'chooseCategory'])->name('consultations.chooseCategory');

// 専門家を選んで相談する
Route::get('/consultations/choose-expert', [ConsultationsController::class, 'chooseExpert'])->name('consultations.chooseExpert');


Route::get('/chats', [ChatsController::class, 'index'])->name('chats.index');


Route::get('/chats/talk', function () {
    return view('chats.talk');
});

Route::post('/chats/talk', [ChatsController::class, 'talk'])->name('chats.talk');

Route::post('/chats/talk', [ChatsController::class, 'talk'])->name('chats.talk'); // チャット画面
Route::get('/chats/form', [ChatsController::class, 'form'])->name('chats.form'); // フォーム付きのチャット画面
Route::post('/chats/store', [ChatsController::class, 'store'])->name('chats.store');


// 認証が必要なルート（グループ化）
Route::middleware(['auth', 'verified'])->group(function () {
    // ダッシュボード
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // プロフィール管理
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

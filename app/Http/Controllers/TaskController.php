<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\CreditTransaction;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * ダッシュボードを表示
     */
    public function index()
    {
        $user = Auth::user();

        // ユーザーのタスクを「未完了」「進行中」「完了」のカテゴリごとに取得
        $tasks = [
            'todo' => Task::where('user_id', $user->id)->where('status', '未完了')->get(),
            'inprogress' => Task::where('user_id', $user->id)->where('status', '進行中')->get(),
            'done' => Task::where('user_id', $user->id)->where('status', '完了')->get(),
        ];

         // ユーザーの現在のクレジット
        $credits = $user->credits;

        // 使用済みクレジット（クレジット履歴の合計）
        $usedCredits = CreditTransaction::where('user_id', $user->id)
            ->where('type', 'task_usage')
            ->sum('amount');

        // `dashboard` ビューに渡す
        return view('dashboard', compact('tasks', 'credits', 'usedCredits'));
    }

    /**
     * タスク作成フォームの表示
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * タスクの作成処理
     */
    public function store(Request $request)
{
    // バリデーション
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'comment' => 'nullable|string',
        'status' => 'required|in:未完了,進行中,完了',
        'is_ratio_request' => 'nullable|boolean'  // ラティオからの依頼か判定
    ]);

    // 現在のユーザーを取得
    $user = Auth::user();

    // ✅ `is_ratio_request` が true の場合、`is_bpo_task` を true に設定
    $isBpoTask = $request->has('is_ratio_request') && $request->is_ratio_request;


    // クレジット消費ロジック
    if ($isBpoTask) {
        // タスク種類ごとのクレジット消費量を定義
        $creditMapping = [
            '契約書関連' => 10,  // 契約書作成・チェック
            '請求書関連' => 2,    // 請求書・見積書・納品書発行
            'スライド資料作成' => 5       // スライド資料作成（5枚）
        ];

        // 依頼されたタスクのクレジットコストを取得
        $taskType = $request->title; // フロントエンドから渡されるタスク種類
        $creditCost = $creditMapping[$taskType] ?? 0;

        // ユーザーの残クレジットを取得
        $remainingCredits = $user->credits;

        if ($remainingCredits < $creditCost) {
            return response()->json(['success' => false, 'message' => 'クレジットが不足しています。'], 400);
        }

        // クレジットを減少させる処理
        $user->credits -= $creditCost;
        $user->save();

        // クレジット消費履歴を保存
        CreditTransaction::create([
            'user_id' => $user->id,
            'amount' => -$creditCost, // クレジット消費は負の値で記録
            'type' => 'task_usage',
            'description' => "タスク依頼 ($taskType)"
        ]);
    }

    // タスクを作成
    $task = Task::create([
        'user_id' => $user->id,
        'title' => $validated['title'],
        'comment' => $validated['comment'] ?? '',
        'deadline' => now()->addDays(7), // デフォルトで7日後
        'status' => '未完了', // 依頼されたタスクは未完了で開始
        'is_displayed_on_main' => false,
        'completed_at' => null,
        'is_deleted' => false,
        'is_bpo_task' => $isBpoTask, // ✅ ここを追加
    ]);

    // **JSON でフロントエンドに新規タスクを返す**
    return response()->json([
        'success' => true,
        'task' => $task,
        'usedCredits' => $creditCost
    ]);
}




    public function updateStatus(Request $request, Task $task)
{
    // バリデーション
    $validated = $request->validate([
        'status' => 'required|in:未完了,進行中,完了'
    ]);

    // ステータスを更新
    $task->update(['status' => $validated['status']]);

    return response()->json(['message' => 'Task status updated successfully']);
}

    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return response()->json(['success' => true, 'message' => 'タスクを削除しました。']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => '削除に失敗しました。'], 500);
        }
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard')->with('success', 'タスクを更新しました！');
    }




}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
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

        // tasks をビューに渡してダッシュボードを表示
        return view('dashboard', compact('tasks'));
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
        'status' => 'required|in:未完了,進行中,完了',
    ]);

    // 現在のユーザーを取得
    $user = Auth::user();

    // タスクを作成
    $task = Task::create([
        'user_id' => $user->id,
        'title' => $validated['title'],
        'comment' => '',
        'deadline' => now()->addDays(7), // デフォルトで7日後
        'status' => $validated['status'],
        'is_displayed_on_main' => false,
        'completed_at' => null,
        'is_deleted' => false
    ]);

    // **JSON でフロントエンドに新規タスクを返す**
    return response()->json(['success' => true, 'task' => $task]);
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

}

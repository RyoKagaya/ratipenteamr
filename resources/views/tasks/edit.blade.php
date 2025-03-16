<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            タスク編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">タスク編集</h3>

                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- ✅ タスク名 (title) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">タスク名:</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" class="w-full border p-2 rounded-md">
                    </div>

                    <!-- ✅ 説明 (comment) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">説明:</label>
                        <textarea name="comment" class="w-full border p-2 rounded-md" rows="3">{{ old('comment', $task->comment) }}</textarea>
                    </div>

                    <!-- ✅ 締切 (deadline) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">締切:</label>
                        <input type="date" name="deadline" value="{{ old('deadline', $task->deadline) }}" class="w-full border p-2 rounded-md">
                    </div>

                    <!-- ✅ ステータス -->
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">ステータス:</label>
                        <select name="status" class="w-full border p-2 rounded-md">
                            <option value="未完了" {{ $task->status == '未完了' ? 'selected' : '' }}>未完了</option>
                            <option value="進行中" {{ $task->status == '進行中' ? 'selected' : '' }}>進行中</option>
                            <option value="完了" {{ $task->status == '完了' ? 'selected' : '' }}>完了</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">更新</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('タスク管理') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6" x-data="taskBoard()">

                <!-- ラティペンの挨拶 -->
                <div class="bg-white p-4 rounded-lg flex items-center shadow">
                    <img src="/img/ratipen_nothing.png" alt="ラティペン" class="w-16 h-16 rounded-full">
                    <p class="ml-4 text-lg font-semibold text-gray-800 dark:text-gray-100">
                        <span x-text="greetingMessage()"></span>
                    </p>
                </div>

                <!-- タスク管理 -->
                <div class="flex justify-between mt-6 space-x-4">

                    <!-- 各タスクカテゴリ -->
                    <template x-for="(status, key) in taskStatuses" :key="key">
                        <div class="w-1/3 p-4 rounded-lg shadow"
                            :class="status.bgColor"
                            x-on:drop="drop($event, key)"
                            x-on:dragover.prevent x-on:dragenter.prevent>

                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2" :class="status.iconColor" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="status.iconPath" />
                                </svg>
                                <span x-text="status.label"></span>
                            </h3>

                            <!-- タスクリスト -->
                            <ul class="space-y-2">
                                <template x-for="task in tasks[key]" :key="task.id">
                                    <li class="p-3 bg-white dark:bg-gray-600 rounded-lg shadow-md transition-shadow duration-200 cursor-move hover:shadow-lg"
                                        draggable="true"
                                        x-on:dragstart="drag($event, task, key)">
                                        <span x-text="task.name"></span>
                                    </li>
                                </template>

                                <!-- 新規タスク入力フォーム（ボタンの上に表示） -->
                                <li x-show="selectedStatus === key"
                                class="p-3 bg-white dark:bg-gray-600 rounded-lg shadow-md mt-2">

                                <input type="text"
                                    x-model="newTaskName"
                                    class="w-full border-none border-white outline-none bg-transparent focus:ring-0 focus:border-none placeholder-gray-400 text-gray-900 dark:text-gray-100 caret-gray-600"
                                    placeholder="タスクを入力する"
                                    @keydown.enter="addTask()"
                                    @keydown.escape="closeAddTaskForm()"
                                    x-ref="taskInput"
                                    autofocus>
                                </li>

                                <!-- タスク追加ボタン -->
                                <li class="mt-2">
                                    <button class="text-gray-700 hover:bg-gray-200 flex items-center w-full rounded-md py-2 px-2"
                                        x-on:click="openAddTaskForm(key)">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        カードを追加
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </template>
                </div>

            </div>
        </div>
    </div>

    <!-- Alpine.jsによるドラッグ＆ドロップ管理 -->
    <script>
        function taskBoard() {
            return {
                tasks: {
                    todo: [{ id: 1, name: '請求書作成' }, { id: 2, name: '経費精算' }],
                    inprogress: [{ id: 3, name: 'レポート作成' }],
                    done: [{ id: 4, name: '支払い処理' }]
                },
                taskStatuses: {
                    todo: { label: "未完了", bgColor: "bg-red-50", iconColor: "text-red-500", iconPath: "M12 9v3m0 4h.01M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Z" },
                    inprogress: { label: "進行中", bgColor: "bg-yellow-50", iconColor: "text-yellow-500", iconPath: "M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" },
                    done: { label: "完了", bgColor: "bg-green-50", iconColor: "text-green-500", iconPath: "M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" }
                },
                newTaskName: "",
                selectedStatus: "",

                drag(event, task, from) {
                    event.dataTransfer.setData("task", JSON.stringify(task));
                    event.dataTransfer.setData("from", from);
                },
                drop(event, to) {
                    const task = JSON.parse(event.dataTransfer.getData("task"));
                    const from = event.dataTransfer.getData("from");

                    this.tasks[from] = this.tasks[from].filter(t => t.id !== task.id);
                    this.tasks[to].push(task);
                },
                incompleteTaskCount() {
                    return this.tasks.todo.length + this.tasks.inprogress.length;
                },
                greetingMessage() {
                    const count = this.incompleteTaskCount();
                    if (count === 0) return `「こんにちは、{{ Auth::user()->name }}さん！🎉 今月のタスクはすべて完了しているよ！✨🐧」`;
                    if (count === 1) return `「こんにちは、{{ Auth::user()->name }}さん！あと ${count} 件のタスクがあるよ！もう少しだね！🐧💪」`;
                    if (count === 2) return `「こんにちは、{{ Auth::user()->name }}さん！あと ${count} 件のタスクがあるよ！がんばって！🐧🔥」`;
                    return `「こんにちは、{{ Auth::user()->name }}さん！今月の残りタスクは ${count} 件 だよ！🐧✨」`;
                },
                openAddTaskForm(status) {
                    this.selectedStatus = status;
                    this.newTaskName = "";
                    this.$nextTick(() => this.$refs.taskInput.focus());
                },
                closeAddTaskForm() {
                    this.selectedStatus = "";
                },
                addTask() {
                    if (this.newTaskName.trim() !== "") {
                        this.tasks[this.selectedStatus].push({ id: Date.now(), name: this.newTaskName });
                        this.closeAddTaskForm();
                    }
                }
            }
        }
    </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('タスク管理') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6" x-data="taskBoard({{ json_encode($tasks) }})">


                <!-- ラティペンの挨拶 -->
                <div class="bg-white px-4 pb-4 rounded-lg flex items-center">
                    <img src="/img/ratipen_nothing.png" alt="ラティペン" class="w-12 h-12 rounded-full">
                    <p class="ml-4 text-base font-semibold text-gray-800 dark:text-gray-100">
                        <span x-text="greetingMessage()"></span>
                    </p>
                </div>

                <!-- タスク管理 -->
                <div class="flex justify-between mt-2 space-x-4">

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
                                    <li class="p-3 bg-white dark:bg-gray-600 rounded-lg shadow-md transition-shadow duration-200 cursor-move hover:shadow-lg flex justify-between items-center"
                                        draggable="true"
                                        x-on:dragstart="drag($event, task, key)">

                                        <!-- ✅ ラティオロゴ (is_bpo_task が true の場合のみ表示) -->
                                        <img x-show="task.is_bpo_task" src="{{ asset('img/Ratioblue.PNG') }}" alt="RATIO" class="w-6 h-6 mr-2 bg-white rounded-full border border-gray-200">

                                        <!-- ✅ タスク名をクリックすると編集ページに遷移 -->
                                        <span class="flex-1 truncate cursor-pointer"
                                        x-text="task.title"
                                        x-on:click="goToTaskEdit(task.id)">
                                        </span>

                                        <!-- ゴミ箱アイコン（削除ボタン） -->
                                        <button x-on:click="deleteTask(task.id, key)" class="text-gray-400 hover:text-gray-700 ml-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
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

                                <!-- タスク追加ボタン (未完了のタスクの下にのみ表示) -->
                                <li x-show="key === 'todo'" class="mt-2">
                                    <button class="text-gray-700 hover:bg-gray-200 flex items-center w-full rounded-md py-2 px-2"
                                        x-on:click="openAddTaskForm(key)">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        タスクを追加
                                    </button>
                                </li>

                            </ul>
                        </div>
                    </template>
                </div>

            </div>

            <!-- クレジット管理 & ラティオに依頼 (横並び) -->
            <div class="flex flex-col md:flex-row gap-6 mt-6">

                <!-- クレジット管理 -->
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2">
                        クレジット管理
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                        ラティオにタスクを依頼するにはクレジットが必要です
                    </p>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 dark:text-gray-100">現在のクレジット</span>
                            <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $credits }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 dark:text-gray-100">使用済みクレジット</span>
                            <span class="text-xl font-bold text-gray-900 dark:text-white">{{ abs($usedCredits) }}</span>
                        </div>
                    </div>



                    <button class="w-full mt-4 py-2 px-4 border rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        クレジットを購入
                    </button>
                </div>


                <!-- ラティオに依頼 -->
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2">
                        ラティオにタスクを依頼
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                        クレジットを使用してラティオにタスクを依頼できます
                    </p>

                    <form x-data="taskBoard({})" x-on:submit.prevent="submitRequest" @keydown.enter="submitRequest">
                        <!-- タスク種類選択 -->
                        <label class="block mb-2 text-gray-700 dark:text-gray-300">タスクの種類</label>
                        <select x-model="selectedTask" x-on:change="updateCreditCost"
                            class="w-full p-2 border border-gray-200 rounded-md bg-white dark:bg-gray-700 dark:text-gray-200">
                            <option value="" disabled selected>タスクを選択</option>
                            <option value="契約書関連">契約書作成・チェック</option>
                            <option value="請求書関連">請求書・見積書・納品書発行</option>
                            <option value="スライド資料作成">スライド資料作成（5枚）</option>
                        </select>

                        <!-- 依頼内容入力 -->
                        <label class="block mt-4 mb-2 text-gray-700 dark:text-gray-300">依頼内容</label>
                        <textarea x-model="requestDetails" class="w-full p-2 border border-gray-200 rounded-md bg-white dark:bg-gray-700 dark:text-gray-200"
                            rows="3" placeholder="タスクの詳細を入力..."></textarea>

                        <!-- 依頼ボタン -->
                        <button type="submit"
                            class="w-full mt-3 py-2 px-4 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 transition"
                            x-text="buttonText">
                        </button>

                        <!-- メッセージ表示 (成功時は緑、エラー時は赤) -->
                        <p class="mt-2 text-sm flex items-center"
                        :class="requestSuccess ? 'text-blue-600' : 'text-gray-600'">
                            <svg x-show="requestSuccess" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span x-text="requestMessage"></span>
                        </p>
                    </form>
                </div>
            </div>

        </div>


        </div>

</div>



    </div>

    <!-- Alpine.jsによるタスク管理 -->
    <script>
        function taskBoard(initialTasks) {



        return {
            // Laravelから取得したタスクデータをAlpine.jsにセット
            tasks: {
                todo: initialTasks.todo,
                inprogress: initialTasks.inprogress,
                done: initialTasks.done
            },
            taskStatuses: {
                todo: { label: "未完了", bgColor: "bg-red-50", iconColor: "text-red-500", iconPath: "M12 9v3m0 4h.01M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Z" },
                inprogress: { label: "進行中", bgColor: "bg-yellow-50", iconColor: "text-yellow-500", iconPath: "M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" },
                done: { label: "完了", bgColor: "bg-green-50", iconColor: "text-green-500", iconPath: "M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" }
            },

            credits: initialTasks.credits || 10, // Laravel から受け取ったクレジット情報を適用
            newTaskName: "",
            selectedStatus: "",
            requestDetails: "",
            requestSuccess: false, // 成功フラグを追加
            requestMessage: "",
            selectedTask: "", // 選択されたタスク
            creditCost: 0, // 選択されたタスクのクレジット消費量
            buttonText: "ラティオに依頼", // ボタンのデフォルトテキスト

            // ✅ タスクの編集ページへ遷移する関数
            goToTaskEdit(taskId) {
                window.location.href = `/tasks/${taskId}/edit`;
            },

            selectedTaskDetail: null,

            // タスクごとのクレジット消費設定
            taskCreditMapping: {
                契約書関連: 10,  // 契約書作成・チェック
                請求書関連: 2,    // 請求書・見積書・納品書発行
                スライド資料作成: 5       // スライド資料作成（5枚）
            },

            // タスク選択時にクレジット消費量を変更
            updateCreditCost() {
                this.creditCost = this.taskCreditMapping[this.selectedTask] || 0;
                this.updateButtonText();
            },

             // ボタンのテキストを更新
            updateButtonText() {
                this.buttonText = this.creditCost > 0
                    ? `${this.creditCost}クレジットでラティオに依頼`
                    : "ラティオに依頼";
            },

            openTaskModal(task) {
                this.selectedTaskDetail = { ...task };
            },


            // タスクのドラッグ開始
            drag(event, task, from) {
                event.dataTransfer.setData("task", JSON.stringify(task));
                event.dataTransfer.setData("from", from);
            },

            // タスクのドロップ処理（データベースにも反映）
            drop(event, to) {
                const task = JSON.parse(event.dataTransfer.getData("task"));
                const from = event.dataTransfer.getData("from");

                // 元のカテゴリからタスクを削除
                this.tasks[from] = this.tasks[from].filter(t => t.id !== task.id);

                // 新しいカテゴリにタスクを追加
                this.tasks[to].push(task);

                // データベースを更新
                fetch(`/tasks/${task.id}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: this.getStatusName(to) })
                });
            },

            // カテゴリのキーを対応するステータス名に変換
            getStatusName(key) {
                return key === 'todo' ? '未完了' : key === 'inprogress' ? '進行中' : '完了';
            },

            // 挨拶メッセージの取得
            greetingMessage() {
                const count = this.tasks.todo.length + this.tasks.inprogress.length;
                return count === 0 ? `「こんにちは、{{ Auth::user()->name }}さん！🎉 今月のタスクはすべて完了しているよ！✨🐧」`
                    : `「こんにちは、{{ Auth::user()->name }}さん！あと ${count} 件のタスクがあるよ！🐧💪」`;
            },

            // タスク追加フォームを開く
            openAddTaskForm(status) {
                this.selectedStatus = status;
                this.newTaskName = "";
                this.$nextTick(() => this.$refs.taskInput.focus());
            },

            // フォームを閉じる
            closeAddTaskForm() {
                this.selectedStatus = "";
                this.newTaskName = "";
            },

            // **タスクを追加する処理**
            addTask() {
                if (this.newTaskName.trim() === "") return; // 空の入力を防ぐ

                const newTask = {
                    title: this.newTaskName,
                    status: this.getStatusName(this.selectedStatus)
                };

                fetch("/tasks", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify(newTask)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.tasks[this.selectedStatus].push(data.task); // タスクリストに追加
                        this.closeAddTaskForm(); // 入力フォームを閉じる
                    } else {
                        alert("タスクの追加に失敗しました。");
                    }
                })
                .catch(error => {
                    console.error("エラー:", error);
                    alert("サーバーに接続できませんでした。");
                });
            },



            deleteTask(taskId, statusKey) {
            if (!confirm("本当にこのタスクを削除しますか？")) {
                return;
            }

            fetch(`/tasks/${taskId}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Alpine.js の reactivity を活かすため、tasks オブジェクトを更新
                    this.tasks[statusKey] = this.tasks[statusKey].filter(task => task.id !== taskId);
                } else {
                    alert("タスクの削除に失敗しました。");
                }
            })
            .catch(error => {
                console.error("エラー:", error);
                alert("サーバーエラーが発生しました。");
            });
        },



        submitRequest() {
        if (!this.selectedTask) {
            this.requestMessage = "タスクの種類を選択してください。";
            this.requestSuccess = false;
            return;
        }
        if (this.requestDetails.trim() === "") {
            this.requestMessage = "依頼内容を入力してください。";
            this.requestSuccess = false;
            return;
        }
        if (this.credits < this.creditCost) {
            this.requestMessage = "クレジットが不足しています。";
            this.requestSuccess = false;
            return;
        }

        // ✅ ラティオ経由のタスクとして `is_ratio_request: true` を送信
        const newTask = {
            title: this.selectedTask,
            comment: this.requestDetails,
            status: "未完了",
            is_ratio_request: true // ✅ ここを追加
        };

        fetch("/tasks", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify(newTask)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.task) {
                this.requestMessage = "タスクの依頼が確定しました！";
                this.requestSuccess = true;
                this.requestDetails = "";
                this.selectedTask = "";
                this.creditCost = 0;
                this.updateButtonText();
                this.credits -= data.usedCredits;

                // ✅ 追加されたタスクの `is_bpo_task` が `true` か確認
                console.log("追加されたタスク:", data.task);

                // 未完了タスクリストに追加
                this.tasks.todo.push({ ...data.task });

                // ✅ 3秒後にメッセージを消す
                setTimeout(() => {
                    this.requestMessage = "";
                }, 3000);
            } else {
                this.requestMessage = "送信に失敗しました。";
                this.requestSuccess = false;
            }
        })
        .catch(error => {
            console.error("APIエラー:", error);
            this.requestMessage = "タスクの依頼が確定しました";
            this.requestSuccess = false;
        });
    }




    };
    }

    </script>
</x-app-layout>

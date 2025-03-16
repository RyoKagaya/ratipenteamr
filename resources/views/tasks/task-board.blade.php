<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6"
     x-data="taskBoard({{ json_encode($tasks) }})">

    <!-- ラティペンの挨拶 -->
    <div class="bg-white p-4 rounded-lg flex items-center shadow">
        <img src="/img/ratipen_nothing.png" alt="ラティペン" class="w-16 h-16 rounded-full">
        <p class="ml-4 text-lg font-semibold text-gray-800 dark:text-gray-100">
            <span x-text="greetingMessage()"></span>
        </p>
    </div>

    <!-- タスク一覧 -->
    @include('tasks.task-status-list')

</div>

<script>
    function taskBoard(initialTasks) {
        return {
            tasks: initialTasks,
            selectedStatus: "",
            newTaskName: "",

            drag(event, task, from) {
                event.dataTransfer.setData("task", JSON.stringify(task));
                event.dataTransfer.setData("from", from);
            },

            drop(event, to) {
                const task = JSON.parse(event.dataTransfer.getData("task"));
                const from = event.dataTransfer.getData("from");

                this.tasks[from] = this.tasks[from].filter(t => t.id !== task.id);
                this.tasks[to].push(task);

                fetch(`/tasks/${task.id}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: to })
                });
            },

            openAddTaskForm(status) {
                this.selectedStatus = status;
                this.newTaskName = "";
                this.$nextTick(() => this.$refs.taskInput.focus());
            },

            closeAddTaskForm() {
                this.selectedStatus = "";
                this.newTaskName = "";
            },

            addTask() {
                if (this.newTaskName.trim() === "") return;

                fetch("/tasks", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({ title: this.newTaskName, status: this.selectedStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.tasks[this.selectedStatus].push(data.task);
                        this.closeAddTaskForm();
                    }
                })
                .catch(error => {
                    console.error("エラー:", error);
                });
            }
        };
    }
</script>

<div class="flex justify-between mt-6 space-x-4">
    @foreach ($taskStatuses as $key => $status)
        <div class="w-1/3 p-4 rounded-lg shadow {{ $status['bgColor'] }}"
            x-on:drop="drop($event, '{{ $key }}')"
            x-on:dragover.prevent x-on:dragenter.prevent>

            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <svg class="w-6 h-6 mr-2 {{ $status['iconColor'] }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $status['iconPath'] }}" />
                </svg>
                {{ $status['label'] }}
            </h3>

            <ul class="space-y-2">
                @foreach ($tasks[$key] as $task)
                    <li class="p-3 bg-white rounded-lg shadow-md flex justify-between"
                        draggable="true"
                        x-on:dragstart="drag($event, {{ json_encode($task) }}, '{{ $key }}')">

                        <span>{{ $task->title }}</span>
                        <button x-on:click="deleteTask({{ $task->id }}, '{{ $key }}')" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </li>
                @endforeach
            </ul>

            <!-- タスク追加ボタン -->
            <button class="text-gray-700 hover:bg-gray-200 flex items-center w-full rounded-md py-2 px-2 mt-2"
                x-on:click="openAddTaskForm('{{ $key }}')">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                カードを追加
            </button>

        </div>
    @endforeach
</div>

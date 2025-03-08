<!-- チャット入力エリア -->
<div class="absolute bottom-0 w-4/5 p-3 flex flex-col justify-center items-center">
    <div id="chat-container" class="w-1/2 my-6">
        <!-- チャット履歴 -->
        <div id="chat-box" class="h-80 overflow-y-auto border border-gray-300 rounded-md p-3 bg-white">
            <!-- ここにチャットメッセージが追加される -->
        </div>

        <form id="chat-form" class="flex w-full justify-center items-center mt-4">
            @csrf
            <div class="relative w-full">
                <input
                    name="user_message"
                    id="user_message"
                    placeholder="ラティペンにメッセージを送信する"
                    class="rounded-md w-full p-3 pr-12 bg-white border border-gray-300"
                >
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <p class="text-sm text-gray-400 mt-3">回答は必ずしも正しいとは限りません。重要な情報は確認するようにしてください。</p>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const chatForm = document.getElementById("chat-form");
    const userMessageInput = document.getElementById("user_message");
    const chatBox = document.getElementById("chat-box");

    chatForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const userMessage = userMessageInput.value.trim();
        if (!userMessage) return;

        // ユーザーのメッセージを表示
        appendMessage("あなた", userMessage, "text-right text-blue-500");

        // 入力欄をクリア
        userMessageInput.value = "";

        try {
            const response = await fetch("{{ route('chats.talk') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({ user_message: userMessage }),
            });

            const data = await response.json();

            if (data.reply) {
                appendMessage("Ratipen", data.reply, "text-left text-gray-700");
            }
        } catch (error) {
            console.error("Error:", error);
            appendMessage("Ratipen", "エラーが発生しました。もう一度試してください。", "text-left text-red-500");
        }
    });

    function appendMessage(sender, message, textClass) {
        const messageElement = document.createElement("div");
        messageElement.classList.add("p-2", "mb-2", "rounded-md", textClass);
        messageElement.textContent = `${sender}: ${message}`;
        chatBox.appendChild(messageElement);

        // スクロールを最新メッセージに合わせる
        chatBox.scrollTop = chatBox.scrollHeight;
    }
});
</script>

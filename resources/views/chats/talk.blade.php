@extends('layouts.chat')

@section('content')
    <div class="w-full h-screen flex">
        <div id="chat-container" class="flex-1 flex flex-col h-full bg-white">
            <!-- チャットエリア -->
            <div id="chat-box" class="w-full flex-grow overflow-y-auto p-3 bg-white">
                <!-- メッセージがここに追加される -->
            </div>

            <!-- 入力フォーム -->
            <form id="chat-form" class="fixed bottom-0 left-[58.33%] transform -translate-x-1/2 w-[41.66%] bg-white p-3 flex items-center">
                @csrf
                <div class="relative w-full">
                    <input
                        name="user_message"
                        id="chat-input"
                        placeholder="ラティペンにメッセージを送信する"
                        class="rounded-md w-full p-3 pr-12 border border-gray-300"
                    >
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-500 hover:text-blue-600">
                        <!-- 送信ボタン（SVG） -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const chatForm = document.getElementById("chat-form");
            const chatInput = document.getElementById("chat-input");
            const chatBox = document.getElementById("chat-box");

            chatForm.addEventListener("submit", async function (event) {
                event.preventDefault();

                const userMessage = chatInput.value.trim();
                if (!userMessage) return;

                // ユーザーのメッセージを表示（右側）
                addMessage(userMessage, true);

                // 入力欄をクリア
                chatInput.value = "";

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
                        addMessage(data.reply, false);
                    }
                } catch (error) {
                    console.error("Error:", error);
                    addMessage("エラーが発生しました。もう一度試してください。", false);
                }
            });

            function addMessage(message, isUser) {
                const messageDiv = document.createElement("div");
                messageDiv.classList.add("flex", "mb-6", "items-start"); // 🔹 `mb-6` で間隔を広げる

                if (isUser) {
                    messageDiv.classList.add("justify-end");
                } else {
                    messageDiv.classList.add("justify-start");
                }

                // メッセージのテキストを入れる div
                const textDiv = document.createElement("div");
                textDiv.classList.add("p-3", "rounded-lg", "inline-block", "relative");

                if (isUser) {
                    textDiv.classList.add("bg-gray-100", "text-right", "max-w-md");
                } else {
                    textDiv.classList.add("bg-gray-50", "text-left", "max-w-lg", "relative");
                }

                textDiv.textContent = message;

                // ボットのメッセージのときだけアイコンを追加
                if (!isUser) {
                    const iconDiv = document.createElement("div");
                    iconDiv.classList.add("w-12", "h-12", "rounded-full", "bg-cover", "mr-2", "shrink-0");
                    iconDiv.style.backgroundImage = `url('{{ asset('img/Ratipen_nothing.png') }}')`;

                    messageDiv.appendChild(iconDiv);
                }

                messageDiv.appendChild(textDiv);
                chatBox.appendChild(messageDiv);

                // ボットのメッセージのときだけボタンをメッセージ左下に追加
                if (!isUser) {
    const actionDiv = document.createElement("div");
    actionDiv.classList.add("absolute", "bottom-[-40px]", "left-2", "flex", "gap-3"); // 🔹 ボタンをメッセージ左下に配置

    function createButton(svg, text, onClickAction) {
        const btn = document.createElement("button");
        btn.classList.add("relative", "group", "cursor-pointer", "flex", "flex-col", "items-center");

        const svgIcon = document.createElement("span");
        svgIcon.innerHTML = svg;
        svgIcon.classList.add("w-6", "h-6", "text-gray-500", "hover:text-blue-500");

        const tooltip = document.createElement("span");
        tooltip.textContent = text;
        tooltip.classList.add(
            "absolute", "top-full", "mt-1", "left-1/2", "-translate-x-1/2",  // 🔹 ボタンの真下に表示
            "bg-blue-500", "text-white", "text-xs", "rounded-md", "px-2", "py-1",
            "opacity-0", "group-hover:opacity-100", "transition-opacity", "duration-200",
            "whitespace-nowrap" // 🔹 横書き固定
        );

        btn.appendChild(svgIcon);
        btn.appendChild(tooltip);

        if (onClickAction) {
            btn.addEventListener("click", onClickAction);
        }

        return btn;
    }

    // 1️⃣ 📋コピーするボタン
    actionDiv.appendChild(createButton(
        `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
        </svg>
        `,
        "コピーする",
        () => navigator.clipboard.writeText(message)
    ));

    // 2️⃣ 👍良い回答ですボタン
    actionDiv.appendChild(createButton(
        `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
        </svg>
        `,
        "良い回答です"
    ));

    // 3️⃣ 👎よくない回答ですボタン
    actionDiv.appendChild(createButton(
        `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
</svg>
`,
        "良くない回答です"
    ));

    // 4️⃣ 💬ラティオに相談するボタン
    actionDiv.appendChild(createButton(
        `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
        </svg>
        `,
        "ラティオに相談する",
        () => window.location.href = "/consultations"
    ));

    // メッセージの左下にボタンを追加
    textDiv.appendChild(actionDiv);
}


                // スクロールを最新メッセージに移動
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    </script>
@endsection

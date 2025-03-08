<div class="w-1/6 p-3 bg-blue-500 text-white h-screen fixed top-0 left-0">
    <!-- ナビゲーション -->
    <nav>
        <!-- ダッシュボード -->
        <a href="{{ route('dashboard') }}" class="block w-full">
            <div class="w-full text-base bg-blue-400 rounded-md my-3 cursor-pointer hover:bg-orange-400">
                <div class="flex items-center rounded-md p-1">
                    <img src="{{ asset('img/Ratiosymbol.PNG') }}" alt="Ratipen" class="w-8 h-8 mr-2 bg-white rounded-full border border-gray-200">
                    <span class="text-sm font-semibold">ダッシュボード</span>
                </div>
            </div>
        </a>


        <!-- Ratipenに話す -->
        <a href="{{ route('chats.talk') }}" class="block w-full">
            <div class="w-full text-base bg-blue-400 rounded-md cursor-pointer hover:bg-orange-400 p-2 flex items-center">
                <img src="{{ asset('img/Ratipen_nothing.PNG') }}" alt="Ratipen" class="w-8 h-8 mr-2 bg-white rounded-full border border-gray-200">
                <span class="text-sm font-semibold">ラティペンに話す</span>
            </div>
        </a>

        <!-- RATIOに相談 -->
        <a href="{{ route('consultations.index') }}" class="block w-full">
            <div class="w-full text-base bg-blue-400 rounded-md my-3 cursor-pointer hover:bg-orange-400">
                <div class="flex items-center rounded-md p-1">
                    <img src="{{ asset('img/Ratioblue.PNG') }}" alt="RATIO" class="w-8 h-8 mr-2 bg-white rounded-full border border-gray-200">
                    <span class="text-sm font-semibold">ラティオに相談</span>
                </div>
            </div>
        </a>

        <!-- メニュー -->
        <div class="py-6">
            <ul class="relative">
                <!-- アプリケーション -->
                <li class="pl-3 py-2 hover:bg-blue-300 rounded-md group relative cursor-pointer">
                    アプリケーション
                    <ul class="absolute top-0 left-full hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-md w-36 text-slate-800 text-xs">
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Box App</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">請求書 App</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">経費 App</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">債務支払 App</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">給与 App</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">社会保険 App</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">年末調整 App</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">勤怠 App</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">マイナンバー App</li>
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">契約 App</li>
                    </ul>
                </li>

                <!-- 設定 -->
                <li class="pl-3 py-2 hover:bg-blue-300 rounded-md cursor-pointer">設定</li>
            </ul>
        </div>

        <!-- サポートとログアウト -->
        <div class="py-6">
            <ul>
                <li class="pl-3 py-2 hover:bg-blue-300 rounded-md cursor-pointer">サポート</li>
                <li class="pl-3 py-2 hover:bg-blue-300 rounded-md flex cursor-pointer">
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="w-full flex items-center">
                        @csrf
                        <button type="submit" class="w-full flex justify-between items-center text-left">
                            ログアウト
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</div>

{{-- JavaScriptでログアウトのsubmitを制御 --}}
<script>
    document.getElementById("logout-form").addEventListener("submit", function(event) {
        event.stopPropagation(); // 他のフォームの送信を妨げない
    });
</script>

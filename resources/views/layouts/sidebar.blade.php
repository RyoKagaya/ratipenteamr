<div class="w-1/6 h-screen bg-blue-500 text-white fixed top-0 left-0 flex flex-col p-4 shadow-lg">

    <div class="flex items-center justify-start mb-3">
        <a href="{{route('dashboard')}}">
            <img src="{{ asset('img/Ratipen_logo_white.png') }}" alt="Ratipen" class="w-24">
        </a>
    </div>

    <!-- ナビゲーション -->
    <nav class="flex flex-col space-y-3 flex-grow">
        <!-- ダッシュボード -->
        <a href="{{ route('dashboard') }}" class="block w-full">
            <div class="w-full text-base bg-blue-400 rounded-md cursor-pointer hover:bg-orange-400 p-2 flex items-center">
                <img src="{{ asset('img/Ratiosymbol.PNG') }}" alt="Ratipen" class="w-8 h-8 mr-2 bg-white rounded-full border border-gray-200">
                <span class="text-sm font-semibold">ダッシュボード</span>
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
            <div class="w-full text-base bg-blue-400 rounded-md cursor-pointer hover:bg-orange-400 p-2 flex items-center">
                <img src="{{ asset('img/Ratioblue.PNG') }}" alt="RATIO" class="w-8 h-8 mr-2 bg-white rounded-full border border-gray-200">
                <span class="text-sm font-semibold">ラティオに相談</span>
            </div>
        </a>

        <!-- メニュー -->
<div class="py-6">
    <ul class="relative">
        <!-- アプリケーション -->
        <li class="pl-3 py-2 hover:bg-blue-300 rounded-md group relative cursor-pointer">
            アプリケーション
            <ul class="absolute top-0 left-full hidden group-hover:block bg-white border border-gray-200 shadow-lg rounded-md w-36 text-slate-800 text-xs">
                @php
                    $serviceProvider = Auth::user()->service_provider ?? 'none';
                    $appLinks = [
                        'freee' => [
                            '見積書' => 'https://app.secure.freee.co.jp/estimates',
                            '納品書' => 'https://app.secure.freee.co.jp/deliveries',
                            '請求書' => 'https://app.secure.freee.co.jp/invoices',
                            '領収書' => 'https://app.secure.freee.co.jp/receipts'
                        ],
                        'moneyforward' => [
                            '見積書' => 'https://invoice.moneyforward.com/quotes',
                            '納品書' => 'https://invoice.moneyforward.com/deliveries',
                            '請求書' => 'https://invoice.moneyforward.com/billings',
                            '領収書' => 'https://invoice.moneyforward.com/receipts'
                        ],
                        'yayoi' => [
                            '見積書' => 'https://www.yayoi-kk.co.jp/products/invoice/',  // 仮のURL
                            '納品書' => 'https://www.yayoi-kk.co.jp/products/invoice/',  // 仮のURL
                            '請求書' => 'https://www.yayoi-kk.co.jp/products/invoice/',  // 仮のURL
                            '領収書' => 'https://www.yayoi-kk.co.jp/products/invoice/'   // 仮のURL
                        ],
                    ];
                    $currentLinks = $appLinks[$serviceProvider] ?? [];
                @endphp

                @if (!empty($currentLinks))
                    @foreach ($currentLinks as $name => $url)
                        <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                            <a href="{{ $url }}" target="_blank" class="block w-full">{{ $name }}</a>
                        </li>
                    @endforeach
                @else
                    <li class="px-4 py-2 text-gray-400">会計ソフト未設定</li>
                @endif
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

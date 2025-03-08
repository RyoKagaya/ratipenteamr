<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/favicon.PNG') }}" type="image/png" sizes="48x48">
    <title>ラティペン - チャット</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900">

    <div class="flex h-screen">
        <!-- サイドバー -->
        @include('layouts.sidebar')

        <!-- メインコンテンツ -->
        <div class="ml-[16.666%] p-3 h-screen w-full flex flex-col">
            @include('layouts.header') {{-- ヘッダー固定 --}}

            <!-- チャット＆フォームエリア -->
            <main class="flex w-full flex-grow pt-14">
                @yield('content') {{-- ここに各ビューの内容が埋め込まれる --}}
            </main>
        </div>
    </div>

</body>
</html>

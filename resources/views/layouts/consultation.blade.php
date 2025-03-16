<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratipen - 相談窓口</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/favicon.PNG') }}" type="image/png" sizes="48x48">
    <style>
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }
    </style>
</head>

<!-- bodyにx-dataを定義してshowModalの状態を管理 -->
<body x-data="{ showModal: false, selectedCategory: '' }"
x-data="{ showModal: false }"
      :class="showModal ? 'bg-gray-900 bg-opacity-50 backdrop-blur-md' : 'bg-white'"
      class="text-gray-900 transition-all duration-300">

    <div class="flex">
        @include('layouts.sidebar')

        <!-- ここに x-data を入れない -->
        <div class="ml-[16.666%] p-6 h-screen w-full">
            @include('layouts.header')

            @yield('content')

            <!-- 波の画像 -->
            <div class="w-full h-40 bg-no-repeat bg-bottom bg-cover"
                style="background-image: url('{{ asset('img/wave.png') }}');">
            </div>

            <footer class="w-full bg-blue-500 text-white text-center py-6">
                <p>© 2025 Ratipen. All rights reserved.</p>
            </footer>
        </div>
    </div>

</body>
</html>

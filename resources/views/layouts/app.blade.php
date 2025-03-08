<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ratipen') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" href="{{ asset('img/favicon.PNG') }}" type="image/png" sizes="48x48">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

    <div class="flex h-screen">
        <!-- サイドバー -->
        @include('layouts.sidebar')

        <!-- メインコンテンツエリア -->
        <div class="ml-[16.666%] flex flex-col w-full">  <!-- ✅ 修正済み -->
            <!-- ヘッダー -->
            @include('layouts.header')

            <!-- コンテンツエリア -->
            <main class="flex-grow overflow-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>

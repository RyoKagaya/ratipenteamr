@extends('layouts.consultation')

@section('content')
<div class="flex">
    <!-- サイドバー -->
    @include('consultations._sidebar')

    <!-- メインコンテンツ -->
    <div class="ml-[16.666%] p-3 h-screen w-full">
        <div class="container mx-auto py-16 text-center">
            <h2 class="text-3xl font-bold text-gray-900">困ったときの相談窓口</h2>
            <p class="text-gray-600 mt-4">業務の悩みやお困りごと、まずはRatipenに相談してみませんか？</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <!-- 業務内容を選んで相談 -->
                <div class="p-6 bg-gray-100 rounded-lg">
                    <h3 class="text-xl font-semibold">業務内容を選んで相談する</h3>
                    <p class="text-gray-600 mt-2">相談したい業務カテゴリを選択してください。</p>
                    <a href="#" class="mt-4 block bg-blue-500 text-white py-2 px-4 rounded-lg">業務を選択</a>
                </div>

                <!-- 専門家を選んで相談 -->
                <div class="p-6 bg-gray-100 rounded-lg">
                    <h3 class="text-xl font-semibold">専門家を選んで相談する</h3>
                    <p class="text-gray-600 mt-2">特定の専門家に直接相談したい場合はこちら。</p>
                    <a href="#" class="mt-4 block bg-blue-500 text-white py-2 px-4 rounded-lg">専門家を選択</a>
                </div>
            </div>

            <div class="mt-10">
                <p class="text-gray-600">Ratipenの操作でお困りの方はこちら</p>
                <a href="mailto:support@ratipen.com" class="mt-2 block bg-gray-700 text-white py-2 px-4 rounded-lg">お問い合わせ</a>
            </div>
        </div>
    </div>
</div>
@endsection

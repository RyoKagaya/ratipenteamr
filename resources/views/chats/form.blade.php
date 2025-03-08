@extends('layouts.chat')

@section('content')
    <div class="flex w-full h-screen">
        @include('layouts.sidebar')

        <div class="flex-grow p-3 h-full bg-white flex relative">
            <div id="chat-container" class="w-full md:w-2/3 flex flex-col transition-all duration-300">
                @include('layouts.header')
                <div class="w-1/2">
                    <!-- チャットエリア -->
                    <div id="chat-area" class="flex flex-col p-4 h-[70vh] overflow-auto border-t border-gray-300">
                        <div id="chat-messages" class="space-y-4"></div>
                    </div>

                    <!-- チャットボックス -->
                    @include('chats._chatbox')
                </div>
            </div>

            <!-- 書類作成フォーム -->
            <div id="document-form-container" class="w-1/2 p-6 bg-gray-50 border-l border-gray-300 transition-all duration-300">
                <h3 class="text-lg font-semibold text-gray-700">書類作成</h3>
                <form id="document-form" class="mt-4">
                    <label class="block text-sm text-gray-600">会社名</label>
                    <input type="text" class="w-full p-2 border rounded-lg" placeholder="例: 株式会社ラティオ">

                    <label class="block text-sm text-gray-600 mt-4">金額</label>
                    <input type="number" class="w-full p-2 border rounded-lg" placeholder="例: 10000">

                    <label class="block text-sm text-gray-600 mt-4">備考</label>
                    <textarea class="w-full p-2 border rounded-lg" rows="3"></textarea>

                    <button type="submit" class="mt-4 w-full bg-blue-500 text-white py-2 rounded-lg">送信</button>
                </form>
            </div>
        </div>
    </div>
@endsection

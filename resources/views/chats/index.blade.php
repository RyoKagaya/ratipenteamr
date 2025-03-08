@extends('layouts.chat')

@section('content')
    <div class="w-full flex h-screen">
        <!-- サイドバ -->
        @include('layouts.sidebar')

        <!-- メインコンテンツ -->
        <div class="flex-grow w-full p-3 h-full bg-white flex flex-col justify-center items-center">
            <div id="image-container" class="flex flex-col justify-center items-center">
                <img id="character-image" src="{{ asset('img/Ratipen_nothing.PNG') }}" alt="Ratipen" class="h-24">
                <p class="text-center text-2xl mt-4 mb-8 text-gray-700 font-bold">お手伝いできることはありますか？</p>
            </div>

            @include('chats._chatbox')
        </div>
    </div>
@endsection

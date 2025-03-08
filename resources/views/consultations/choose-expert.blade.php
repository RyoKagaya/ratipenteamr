@extends('layouts.consultation')

@section('content')
<div class="container mx-auto py-16 text-center">
    <h2 class="text-3xl font-bold text-gray-900">相談したい専門家を選択してください</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 text-left">
        <a href="#" class="p-6 bg-gray-100 rounded-lg shadow hover:bg-gray-200 transition">
            <h4 class="text-lg font-semibold">税理士</h4>
            <p class="text-gray-600 mt-2">税務相談や節税対策をサポートします。</p>
        </a>
        <a href="#" class="p-6 bg-gray-100 rounded-lg shadow hover:bg-gray-200 transition">
            <h4 class="text-lg font-semibold">会計士</h4>
            <p class="text-gray-600 mt-2">会計処理や経理業務の改善をアドバイスします。</p>
        </a>
        <a href="#" class="p-6 bg-gray-100 rounded-lg shadow hover:bg-gray-200 transition">
            <h4 class="text-lg font-semibold">資金調達アドバイザー</h4>
            <p class="text-gray-600 mt-2">事業拡大に向けた資金調達の方法を支援します。</p>
        </a>
    </div>
</div>
@endsection

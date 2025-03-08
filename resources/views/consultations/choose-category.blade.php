@extends('layouts.consultation')

@section('content')
<div class="container mx-auto py-16 text-center">
    <h2 class="text-3xl font-bold text-gray-900">相談したい業務内容を選択してください</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 text-left">
        <a href="#" class="p-6 bg-gray-100 rounded-lg shadow hover:bg-gray-200 transition">
            <h4 class="text-lg font-semibold">請求書作成</h4>
            <p class="text-gray-600 mt-2">請求書を正しく作成し、送付する方法をサポートします。</p>
        </a>
        <a href="#" class="p-6 bg-gray-100 rounded-lg shadow hover:bg-gray-200 transition">
            <h4 class="text-lg font-semibold">経費精算</h4>
            <p class="text-gray-600 mt-2">領収書の管理や経費処理の方法をアドバイスします。</p>
        </a>
        <a href="#" class="p-6 bg-gray-100 rounded-lg shadow hover:bg-gray-200 transition">
            <h4 class="text-lg font-semibold">税務申告</h4>
            <p class="text-gray-600 mt-2">税務申告の流れや手続きについて説明します。</p>
        </a>
    </div>
</div>
@endsection

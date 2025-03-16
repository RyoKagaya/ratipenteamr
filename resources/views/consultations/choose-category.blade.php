@extends('layouts.consultation')

@section('content')
<div class="container mx-auto py-16 text-center" x-data="{ showModal: false, selectedCategory: '' }">
    <h2 class="text-3xl font-bold text-blue-500">業務内容を選んで相談</h2>
    <p class="text-gray-600 mt-4">お悩みの内容をクリックすると無料でラティオへの相談が可能です。</p>
    <p class="text-gray-600">もし、お悩みが複数ある場合は、該当するお悩みのどれかをクリックしてください。</p>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 text-left">
        @foreach([
            ['経理・財務', '日々の記帳・決算・会計システム導入など', 'accounting.png'],
            ['税務・確定申告', '節税・法人税・消費税・税務相談など', 'tax.png'],
            ['労務・給与計算', '社保手続き・給与計算・勤怠管理など', 'payroll.png'],
            ['契約・法務', '契約書作成・リーガルチェック・規約策定など', 'legal.png'],
            ['資金調達・助成金', '銀行融資・助成金・VC投資・クラファン相談', 'funding.png'],
            ['事業計画・経営相談', '事業計画作成・資本政策・事業戦略立案', 'business-plan.png'],
            ['デザイン・ブランディング', 'ロゴ・Web・資料デザイン・ブランディング戦略', 'design.png'],
            ['その他', 'その他の業務相談はこちら', 'others.png'],
        ] as $category)
        <a href="#"
           class="p-6 bg-gray-50 rounded-lg shadow hover:bg-gray-100 transition flex flex-col items-center text-center"
           @click.prevent="selectedCategory = '{{ $category[0] }}'; showModal = true;">
            <h4 class="text-lg font-semibold text-blue-500">{{ $category[0] }}</h4>
            <img src="{{ asset('img/' . $category[2]) }}" alt="{{ $category[0] }}" class="w-24 h-24 m-3">
        </a>
        @endforeach
    </div>

    <div class="mt-10 flex justify-center gap-6">
        <a href="{{ route('consultations.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
            戻る
        </a>
        <a href="{{ route('consultations.choose-expert') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
            専門家を選んで相談
        </a>
    </div>

    <!-- モーダルウィンドウ (背景暗くなる仕様) -->
    <div x-show="showModal"
         class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 transition-opacity duration-300"
         @click.self="showModal = false"
         x-cloak>
        <div class="bg-white rounded-lg p-6 shadow-lg w-96">
            <h3 class="text-lg font-semibold text-center">ご相談依頼を送信します</h3>
            <div class="mt-4 flex flex-col items-center">
                <div class="p-4 bg-gray-100 rounded-lg text-center">
                    <p class="text-blue-500 font-semibold" x-text="selectedCategory"></p>
                    <p class="text-gray-600">のご相談をラティオの担当に送ります。</p>
                </div>
                <img src="{{ asset('img/consultation.png') }}" alt="相談" class="w-32 my-4">
            </div>
            <div class="flex justify-center gap-4 mt-4">
                <button @click="showModal = false" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">キャンセル</button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">送信する</button>
            </div>
        </div>
    </div>
</div>
@endsection

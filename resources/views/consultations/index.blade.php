@extends('layouts.consultation')

@section('content')
    <section class="container mx-auto text-center py-20">
        <h1 class="text-4xl font-bold text-gray-900">
            経理・バックオフィスのお悩み、<br>ラティオにご相談ください。
        </h1>
        <p class="text-gray-600 text-lg mt-4">
            事務作業、経理業務の効率化、資金調達など<br>
            専門家がしっかりサポートします。
        </p>
        <div class="flex flex-col md:flex-row justify-center gap-6 mt-8">
            <a href="{{ route('consultations.choose-category') }}"
                class="bg-blue-500 text-white text-lg font-bold py-4 px-6 rounded-lg shadow-md
                hover:bg-blue-600 transition text-center">
                業務内容を選んで相談する
            </a>
            <a href="{{ route('consultations.choose-expert') }}"
                class="bg-blue-500 text-white text-lg font-bold py-4 px-6 rounded-lg shadow-md
                hover:bg-blue-600 transition text-center">
                専門家に相談する
            </a>
        </div>
    </section>

    @include('consultations._problems') <!-- こんなお悩みありませんか？ -->
    @include('consultations._features') <!-- ラティオでできること -->
    @include('consultations._flow') <!-- ご相談の流れ -->
    @include('consultations._cta') <!-- 最終CTA -->
@endsection

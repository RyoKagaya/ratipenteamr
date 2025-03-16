@extends('layouts.consultation')

@section('content')
<div class="container mx-auto py-16 text-center">
    <h2 class="text-3xl font-bold text-blue-500">専門家を選んで相談</h2>
    <p class="text-gray-600 mt-4">相談したい専門家をクリックすると無料でラティオへ気軽に相談できます！</p>
    <p class="text-gray-600">「どの専門家に聞けばいいかわからない…」場合も、まずは気になるカテゴリを選んでみてください。</p>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 text-left">
        @foreach([
            ['税理士', '確定申告・節税・税務相談なら'],
            ['会計士', '記帳・決算・経理のアドバイス'],
            ['社労士', '労務管理・給与計算・社会保険'],
            ['弁護士', '契約書チェック・法律相談'],
            ['デザイナー', 'ロゴ・資料作成・ブランド戦略'],
            ['資金調達アドバイザー', '融資・助成金・投資家対応'],
            ['経営コンサル', 'ビジネス全般の相談が可能'],
            ['その他', 'その他の専門家にも相談OK！'],
        ] as $expert)
        <a href="#" class="p-6 bg-gray-50 rounded-lg shadow hover:bg-gray-100 transition">
            <h4 class="text-lg font-semibold text-blue-500">{{ $expert[0] }}</h4>
            <p class="text-gray-600 mt-2">{{ $expert[1] }}</p>
        </a>
        @endforeach
    </div>

    <div class="mt-10 flex justify-center gap-6">
        <a href="{{ route('consultations.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
            戻る
        </a>
        <a href="{{ route('consultations.choose-category') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
            業務内容を選んで相談
        </a>
    </div>
</div>
@endsection

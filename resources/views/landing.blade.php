<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ラティペン - AIエージェント</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/favicon.PNG') }}" type="image/png" sizes="48x48">
    <style>
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">

    <header class="bg-white py-2 shadow fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- ロゴ -->
            <img src="/img/Ratipen_logo_blue.png" alt="Ratipen" class="h-8">

            <!-- ナビゲーション -->
            <nav class="flex items-center space-x-4">
                <a href="{{ route('register') }}" class="px-4 py-1 bg-blue-500 text-white font-semibold rounded-lg border border-blue-500 transition hover:bg-blue-600">
                    サインアップ
                </a>
                <a href="{{ route('login') }}" class="px-4 py-1 border-2 border-blue-500 text-blue-500 font-semibold rounded-lg transition hover:bg-blue-500 hover:text-white">
                    ログイン
                </a>
            </nav>
        </div>
    </header>

    <!-- ヒーローセクション -->
    <section class="text-center py-24 mt-20 bg-white text-gray-700 relative overflow-hidden">
        <h2 class="text-4xl font-extrabold">経理お手伝いAIアシスタント</h2>
        <p class="mt-4 text-lg">ペンギンに話しかけるだけで、経理業務が完了！</p>

        <!-- ペンギン画像をアニメーション付きで表示 -->
        <div class="relative flex justify-center items-center gap-16 mt-6 h-32">
            <!-- 左2 -->
            <img src="/img/nekipen.png" alt="ペンギン1" class="h-24 shadow-lg rounded-lg absolute opacity-0 animate-slide-left-far penguin">
            <!-- 右2 -->
            <img src="/img/Poso-chan_nothing.png" alt="ペンギン5" class="h-24 shadow-lg rounded-lg absolute opacity-0 animate-slide-right-far penguin">
            <!-- 左1 -->
            <img src="/img/garapen_nothing.png" alt="ペンギン4" class="h-24 shadow-lg rounded-lg absolute opacity-0 animate-slide-left penguin">
            <!-- メイン -->
            <img src="/img/ratipen_nothing.png" alt="ペンギン3" class="h-24 shadow-lg rounded-lg relative z-10 animate-fade-in penguin">
            <!-- 右1 -->
            <img src="/img/mosopen_nothing.png" alt="ペンギン2" class="h-24 shadow-lg rounded-lg absolute opacity-0 animate-slide-right penguin">
        </div>

        <!-- CTAボタン -->
        <a href="{{ route('register') }}" class="mt-6 inline-flex items-center gap-2 bg-blue-500 text-white font-bold py-3 px-6 rounded-lg text-lg shadow-md hover:bg-blue-600 transition">
            <!-- Heroiconsのアイコン -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
            </svg>

            話してみる
        </a>
    </section>

    <div class="h-8 bg-gradient-to-b from-white to-blue-50"></div>

    <!-- Tailwind + カスタムCSSアニメーション -->
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: scale(0.5); }
        to { opacity: 1; transform: scale(1); }
    }

    @keyframes slide-left {
        from { opacity: 0; transform: translateX(0) scale(0.8); }
        to { opacity: 1; transform: translateX(-120px) scale(1); }
    }

    @keyframes slide-right {
        from { opacity: 0; transform: translateX(0) scale(0.8); }
        to { opacity: 1; transform: translateX(120px) scale(1); }
    }

    @keyframes slide-left-far {
        from { opacity: 0; transform: translateX(0) scale(0.8); }
        to { opacity: 1; transform: translateX(-240px) scale(1); }
    }

    @keyframes slide-right-far {
        from { opacity: 0; transform: translateX(0) scale(0.8); }
        to { opacity: 1; transform: translateX(240px) scale(1); }
    }

    @keyframes bounce-custom {
        0%, 100% { transform: translateY(0); }
        30% { transform: translateY(-12px); }
        60% { transform: translateY(-8px); }
        90% { transform: translateY(-4px); }
    }

    .animate-fade-in {
        animation: fade-in 0.8s ease-out forwards;
    }

    .animate-slide-left {
        animation: slide-left 0.8s ease-out 0.3s forwards;
    }

    .animate-slide-right {
        animation: slide-right 0.8s ease-out 0.3s forwards;
    }

    .animate-slide-left-far {
        animation: slide-left-far 0.8s ease-out 0.6s forwards;
    }

    .animate-slide-right-far {
        animation: slide-right-far 0.8s ease-out 0.6s forwards;
    }
</style>

    <!-- サービス概要 -->
    <section class="container mx-auto text-center py-16">
        <h3 class="text-3xl font-bold">ラティペンとは</h3>
        <p class="text-gray-600 mt-4">ラティペンは、ひとり起業家のためのAI経理アシスタントです。</p>
        <p class="text-gray-600 mt-4">請求書や見積書の作成、経費精算など、面倒な経理業務をサポートします。</p>
    </section>

    <!-- サービスの特徴 -->
    <section class="w-full text-center py-16 bg-blue-50 ">
        <div class="container mx-auto">
            <h3 class="text-3xl font-bold">特徴</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="p-6">
                    <h4 class="text-lg font-semibold">話しかけるだけ</h4>
                    <img src="/img/conversation.png" alt="話しかけるだけのイメージ" class="h-40 w-auto mx-auto my-4 object-contain rounded-lg">
                    <p class="text-gray-600 mt-2">直感的な対話型インターフェースを採用し、チャットや音声で簡単に請求書・経費精算などの経理業務を完結</p>
                </div>
                <div class="p-6">
                    <h4 class="text-lg font-semibold">プロのサポート付き</h4>
                    <img src="/img/ai_human_support.png" alt="AIとプロのハイブリッドのイメージ" class="h-40 w-auto mx-auto my-4 object-contain rounded-lg">
                    <p class="text-gray-600 mt-2">AIが一次対応し、必要に応じて人間のオペレーターがサポート。シンプルな作業は自動化し、難しい処理は専門家が対応</p>
                </div>
                <div class="p-6">
                    <h4 class="text-lg font-semibold">すぐに利用開始</h4>
                    <img src="/img/quick_start.png" alt="すぐに利用開始のイメージ" class="h-40 w-auto mx-auto my-4 object-contain rounded-lg">
                    <p class="text-gray-600 mt-2">面倒な設定不要！登録したらすぐに利用可能。請求書・領収書作成や経費精算が短時間で完了し、バックオフィス業務の負担を大幅に削減。</p>
                </div>
            </div>
        </div>
    </section>

    <!-- サービス内容 -->
    <section class="container mx-auto text-center py-16">
        <h3 class="text-3xl font-bold">ラティペンでできること</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="p-6">
                <h4 class="text-lg font-semibold">請求書・見積書の発行</h4>
                <img src="/img/invoice_creation.png" alt="請求書作成" class="h-40 w-auto mx-auto mt-4 object-contain rounded-lg">
                <p class="text-gray-600 mt-2">簡単な会話で請求書や見積書を自動作成。</p>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold">領収書・納品書の作成</h4>
                <img src="/img/receipt_creation.png" alt="領収書作成" class="h-40 w-auto mx-auto mt-4 object-contain rounded-lg">
                <p class="text-gray-600 mt-2">必要な情報を入力すれば、書類を即時発行。</p>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold">経費精算</h4>
                <img src="/img/expense_management.png" alt="経費精算" class="h-40 w-auto mx-auto mt-4 object-contain rounded-lg">
                <p class="text-gray-600 mt-2">領収書の写真をアップロードするだけで経費登録完了。</p>
            </div>
        </div>
    </section>


    <!-- 対応システム一覧 -->
    <section class="container mx-auto text-center py-16">
        <h3 class="text-3xl font-bold">対応可能なシステム</h3>
        <p class="text-gray-600 mt-4">ラティペンは、主要な会計・経理システムと連携可能です。</p>

        <div class="flex flex-wrap justify-center gap-8 md:gap-12 mt-8">
            <div class="flex justify-center p-4 md:p-6">
                <img src="/img/freee_logo.png" alt="freee" class="h-20 md:h-24">
            </div>
            <div class="flex justify-center p-4 md:p-6">
                <img src="/img/moneyforward_logo.png" alt="Money Forward" class="h-20 md:h-24">
            </div>
            <div class="flex justify-center p-4 md:p-6">
                <img src="/img/yayoi_logo.png" alt="弥生" class="h-20 md:h-24">
            </div>
            <div class="flex justify-center p-4 md:p-6">
                <img src="/img/bakuraku_logo.png" alt="バクラク" class="h-20 md:h-24">
            </div>
            <div class="flex justify-center p-4 md:p-6">
                <img src="/img/bugyo_logo.png" alt="奉行" class="h-20 md:h-24">
            </div>
            <div class="flex justify-center p-4 md:p-6">
                <img src="/img/rakuraku_logo.png" alt="楽楽精算" class="h-20 md:h-24">
            </div>
            <div class="flex justify-center p-4 md:p-6">
                <img src="/img/jobcan_logo.png" alt="ジョブカン" class="h-20 md:h-24">
            </div>
        </div>
        <p class="text-sm text-gray-400 mt-4">※レギュラープラン以上に限ります。</p>
    </section>




    <!-- 料金プラン -->
    <section class="container mx-auto text-center py-16">
        <h3 class="text-3xl font-bold">料金プラン</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
            <!-- ライトプラン -->
            <div class="p-6 border rounded-lg bg-white flex flex-col items-center">
                <h4 class="text-xl font-semibold">ライトプラン</h4>
                <img src="/img/light_plan.png" alt="ライトプラン" class="h-24 mt-4">
                <p class="text-2xl font-bold mt-2">¥5,000/月</p>
                <p class="text-gray-600 mt-2">AIのみで完結するシンプルなプランです。<br>定型作業を自動化します。</p>
                <a href="{{ route('register') }}" class="mt-6 block border-2 border-blue-500 text-blue-500 py-3 px-4 rounded-lg font-semibold transition hover:bg-blue-500 hover:text-white">はじめる</a>
            </div>

            <!-- レギュラープラン -->
            <div class="relative p-6 border rounded-lg bg-white flex flex-col items-center">
                <div class="absolute top-0 -translate-y-1/2 bg-orange-500 text-white text-sm font-semibold px-3 py-1 rounded-full">
                    おすすめ
                </div>
                <h4 class="text-xl font-semibold">レギュラープラン</h4>
                <img src="/img/regular_plan.png" alt="レギュラープラン" class="h-24 mt-4">
                <p class="text-2xl font-bold mt-2">¥20,000/月</p>
                <p class="text-gray-600 mt-2">AIとヒトのアシスタントが連携し、<br>スムーズな業務サポートを提供します。</p>
                <a href="{{ route('register') }}" class="mt-6 block border-2 border-blue-500 text-blue-500 py-3 px-4 rounded-lg font-semibold transition hover:bg-blue-500 hover:text-white">申し込む</a>
            </div>

            <!-- プロプラン -->
            <div class="p-6 border rounded-lg bg-white flex flex-col items-center">
                <h4 class="text-xl font-semibold">プロプラン</h4>
                <img src="/img/pro_plan.png" alt="プロプラン" class="h-24 mt-4">
                <p class="text-2xl font-bold mt-2">要見積もり</p>
                <p class="text-gray-600 mt-2">AIと公認会計士・税理士などの専門家が<br>経理業務を丁寧にサポートします。</p>
                <a href="mailto:info@ratio-cfo.com" class="mt-6 block border-2 border-blue-500 text-blue-500 py-3 px-4 rounded-lg font-semibold transition hover:bg-blue-500 hover:text-white">
                    お問い合わせ
                </a>
            </div>
        </div>
    </section>



    <!-- ご利用の流れ -->
<section class="w-full text-center py-24 bg-blue-50 border-t border-gray-200 mt-16">
    <div class="container mx-auto">
        <h3 class="text-3xl font-bold">ご利用の流れ</h3>
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 mt-8">

            <!-- ユーザー登録 -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 flex flex-col items-center w-full md:w-80">
                <h4 class="text-xl font-semibold">ユーザー登録</h4>
                <img src="/img/register_icon.png" alt="ユーザー登録" class="h-32 w-32 rounded-full object-cover mx-auto my-4">
                <p class="text-gray-600 mt-2">簡単な情報入力で登録完了。</p>
            </div>

            <!-- 矢印 -->
            <div class="hidden md:flex items-center justify-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
            </div>

            <!-- サービス選択 -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 flex flex-col items-center w-full md:w-80">
                <h4 class="text-xl font-semibold">サービス選択</h4>
                <img src="/img/plan_select_icon.png" alt="サービス選択" class="h-32 w-32 rounded-full object-cover mx-auto my-4">
                <p class="text-gray-600 mt-2">ニーズに合わせてプランを選択。</p>
            </div>

            <!-- 矢印 -->
            <div class="hidden md:flex items-center justify-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
            </div>

            <!-- 利用開始 -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 flex flex-col items-center w-full md:w-80">
                <h4 class="text-xl font-semibold">利用開始</h4>
                <img src="/img/start_using_icon.png" alt="利用開始" class="h-32 w-32 rounded-full object-cover mx-auto my-4">
                <p class="text-gray-600 mt-2">Ratipenが経理業務をサポート開始。</p>
            </div>

        </div>
    </div>
</section>

<!-- 全体の背景を bg-gray-100 に設定 -->
<section class="w-full bg-blue-50 py-16 flex justify-center">
    <div class="w-[80%] md:w-[70%] bg-blue-500 text-white text-center py-12 px-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl md:text-3xl font-bold">
            経理業務を、ラティペンでかんたんに。
        </h2>

        <div class="flex justify-center gap-6 mt-6">
            <!-- 「話してみる」ボタン（オレンジ） -->
            <a href="{{ route('register') }}"
            class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-full text-lg shadow-lg transition hover:bg-orange-600">
                話してみる
            </a>

            <!-- 「ご相談・お問い合わせ」ボタン（白） -->
            <a href="mailto:info@ratio-cfo.com"
            class="px-6 py-3 bg-white text-blue-500 font-semibold rounded-full text-lg shadow-lg border border-white transition hover:bg-gray-100">
                ご相談・お問い合わせ
            </a>
        </div>
    </div>
</section>



<!-- 波の画像 -->
<div class="w-full h-40 bg-no-repeat bg-bottom bg-cover"
    style="background-image: url('img/wave.png');">
</div>

<!-- フッター -->
<footer class="w-full bg-blue-500 text-white text-center py-6">
    <p>© 2025 Ratipen. All rights reserved.</p>
</footer>

<!-- 右下に固定されるラティペン -->
<div class="fixed bottom-8 right-8 flex flex-col items-center space-y-2">
    <!-- 吹き出し -->
    <div class="relative bg-white text-gray-900 text-sm px-4 py-2 rounded-full shadow-lg border border-gray-300 text-center">
        ラティペン<br>
        を試してみる
    </div>

    <!-- ラティペン画像 -->
    <a href="{{ route('register') }}" class="block">
        <img src="/img/ratipen_nothing.png" alt="ラティペン" class="w-24 h-24 bg-white rounded-full drop-shadow-lg transition-transform transform hover:scale-110 border-4 border-white">
    </a>
</div>

</body>
</html>

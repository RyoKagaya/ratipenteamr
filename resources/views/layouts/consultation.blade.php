<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratipen - 相談窓口</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/favicon.PNG') }}" type="image/png" sizes="48x48">
    <style>
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">

    <div class="flex">
        @include('layouts.sidebar')

        <div class="ml-[16.666%] p-6 h-screen w-full">
            @include('layouts.header')

            <!-- ヒーローセクション -->
            <section class="container mx-auto text-center py-20">
                <h1 class="text-4xl font-bold text-gray-900">
                    経理・バックオフィスのお悩み、<br>ラティオにご相談ください。
                </h1>
                <p class="text-gray-600 text-lg mt-4">
                    事務作業、経理業務の効率化、資金調達など<br>
                    専門家がしっかりサポートします。
                </p>
                <div class="flex flex-col md:flex-row justify-center gap-6 mt-8">
                    <a href="{{ route('consultations.chooseCategory') }}"
                        class="bg-blue-500 text-white text-lg font-bold py-4 px-6 rounded-lg shadow-md
                        hover:bg-blue-600 transition text-center">
                        業務内容を選んで相談する
                    </a>
                    <a href="{{ route('consultations.chooseExpert') }}"
                        class="bg-blue-500 text-white text-lg font-bold py-4 px-6 rounded-lg shadow-md
                        hover:bg-blue-600 transition text-center">
                        専門家に相談する
                    </a>
                </div>
            </section>

            <!-- こんなお悩みありませんか？ -->
        <section class="w-full bg-white py-16 text-center">
            <div class="container mx-auto">
                <h3 class="text-3xl text-blue-500 font-bold">こんなお悩み、ラティオなら解決できます</h3>
                <p class="mt-4 text-lg text-gray-700">
                    「バックオフィス業務の最適解がわからない…」<br>
                    バックオフィスのお悩み、ラティオがまるっとサポート！
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-12">
                    <!-- お悩み1 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-blue-100 w-48 h-48 rounded-full flex items-center justify-center">
                            <img src="/img/icon_problem1.png" alt="バックオフィスの最適化が進まない" class="w-32 h-32">
                        </div>
                        <p class="mt-6 text-md font-semibold text-gray-900">
                            バックオフィス業務が苦手で進まない…<br>どこから手をつけるべき？
                        </p>
                    </div>

                    <!-- お悩み2 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-blue-100 w-48 h-48 rounded-full flex items-center justify-center">
                            <img src="/img/icon_problem2.png" alt="誰に相談すればいいかわからない" class="w-32 h-32">
                        </div>
                        <p class="mt-6 text-md font-semibold text-gray-900">
                            誰に相談すればいいのか…<br>適切な専門家が見つからない
                        </p>
                    </div>

                    <!-- お悩み3 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-blue-100 w-48 h-48 rounded-full flex items-center justify-center">
                            <img src="/img/icon_problem3.png" alt="経理・労務・法務の業務が属人化している" class="w-32 h-32">
                        </div>
                        <p class="mt-6 text-md font-semibold text-gray-900">
                            手探りでやっているのでやり方が不安...<br>標準化して効率化したい
                        </p>
                    </div>
                </div>
            </div>
        </section>


            <!-- ラティオでできること -->
<section class="w-full bg-white py-16 text-center">
    <div class="container mx-auto">
        <h3 class="text-3xl text-blue-500 font-bold">ラティオでできること</h3>
        <p class="mt-4 text-lg text-gray-700">
            経理・財務・労務の専門家が、バックオフィスから貴社の成長をサポートします。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 text-center">
            <!-- 仕訳・記帳代行 -->
            <div class="relative p-6 bg-white text-gray-900 border-2 border-blue-500 rounded-lg shadow-md flex flex-col items-center">
                <div class="absolute top-0 -translate-y-1/2 bg-blue-500 text-white text-md font-semibold px-4 py-1 rounded-full border border-blue-500 shadow">
                    仕訳・記帳代行
                </div>
                <p class="mt-3 text-sm text-gray-700">
                    会計のプロが、取引内容を正しく分類し、日々の帳簿を作成。月次決算のスピードを向上させます。
                </p>
            </div>

            <!-- 資金調達サポート -->
            <div class="relative p-6 bg-white text-gray-900 border-2 border-blue-500 rounded-lg shadow-md flex flex-col items-center">
                <div class="absolute top-0 -translate-y-1/2 bg-blue-500 text-white text-md font-semibold px-4 py-1 rounded-full border border-blue-500 shadow">
                    資金調達サポート
                </div>
                <p class="mt-3 text-sm text-gray-700">
                    融資・補助金・助成金の申請、投資家向けの財務資料作成など、成長資金の確保をサポートします。
                </p>
            </div>

            <!-- 労務・給与計算 -->
            <div class="relative p-6 bg-white text-gray-900 border-2 border-blue-500 rounded-lg shadow-md flex flex-col items-center">
                <div class="absolute top-0 -translate-y-1/2 bg-blue-500 text-white text-md font-semibold px-4 py-1 rounded-full border border-blue-500 shadow">
                    労務・給与計算
                </div>
                <p class="mt-3 text-sm text-gray-700">
                    社会保険手続き、給与計算、勤怠管理など、人事労務の専門家が正確に処理します。
                </p>
            </div>

            <!-- 契約・法務サポート -->
            <div class="relative p-6 bg-white text-gray-900 border-2 border-blue-500 rounded-lg shadow-md flex flex-col items-center">
                <div class="absolute top-0 -translate-y-1/2 bg-blue-500 text-white text-md font-semibold px-4 py-1 rounded-full border border-blue-500 shadow">
                    契約・法務サポート
                </div>
                <p class="mt-3 text-sm text-gray-700">
                    契約書の作成・レビュー、契約管理など、企業のリスクを最小限に抑える法務サポートを提供します。
                </p>
            </div>

            <!-- デザイン関連 -->
            <div class="relative p-6 bg-white text-gray-900 border-2 border-blue-500 rounded-lg shadow-md flex flex-col items-center">
                <div class="absolute top-0 -translate-y-1/2 bg-blue-500 text-white text-md font-semibold px-4 py-1 rounded-full border border-blue-500 shadow">
                    デザイン関連
                </div>
                <p class="mt-3 text-sm text-gray-700">
                    投資家向け資料のデザイン、ブランディング強化、営業資料のブラッシュアップを支援します。
                </p>
            </div>

            <!-- その他カスタマイズ支援 -->
            <div class="relative p-6 bg-white text-gray-900 border-2 border-blue-500 rounded-lg shadow-md flex flex-col items-center">
                <div class="absolute top-0 -translate-y-1/2 bg-blue-500 text-white text-md font-semibold px-4 py-1 rounded-full border border-blue-500 shadow">
                    その他
                </div>
                <p class="mt-3 text-sm text-gray-700">
                    個別ニーズに応じたカスタマイズ支援や、バックオフィスの改善提案を行います。
                </p>
            </div>
        </div>
    </div>
</section>



            <!-- ご相談の流れ -->
            <section class="w-full text-center py-24 bg-blue-50 border-t border-gray-200 mt-16">
                <div class="container mx-auto">
                    <h3 class="text-3xl font-bold">ご相談の流れ</h3>
                    <div class="flex flex-col md:flex-row items-center justify-center gap-8 mt-8">
                        <!-- ステップ1 -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 flex flex-col items-center w-full md:w-80">
                            <h4 class="text-xl font-semibold">相談内容を選ぶ</h4>
                            <img src="/img/flow_step1.png" alt="相談内容を選ぶ" class="h-32 w-32 rounded-full object-cover mx-auto my-4">
                            <p class="text-gray-600 mt-2">「業務内容」または「専門家」から相談内容を選択</p>
                        </div>

                        <!-- 矢印 -->
                        <div class="hidden md:flex items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </div>

                        <!-- ステップ2 -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 flex flex-col items-center w-full md:w-80">
                            <h4 class="text-xl font-semibold">ヒアリング</h4>
                            <img src="/img/flow_step2.png" alt="ヒアリング" class="h-32 w-32 rounded-full object-cover mx-auto my-4">
                            <p class="text-gray-600 mt-2">お悩みや業務課題を専門スタッフが詳しくヒアリング</p>
                        </div>

                        <!-- 矢印 -->
                        <div class="hidden md:flex items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </div>

                        <!-- ステップ3 -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 flex flex-col items-center w-full md:w-80">
                            <h4 class="text-xl font-semibold">最適なサポート提案</h4>
                            <img src="/img/flow_step3.png" alt="最適なサポート提案" class="h-32 w-32 rounded-full object-cover mx-auto my-4">
                            <p class="text-gray-600 mt-2">ヒアリング内容をもとに、あなたの課題に最適なプランをご提案</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 最終CTA -->
            <section class="w-full bg-blue-50 py-16 flex justify-center">
                <div class="w-[80%] md:w-[70%] bg-blue-500 text-white text-center py-12 px-6 rounded-2xl shadow-lg">
                    <h2 class="text-2xl md:text-3xl font-bold">
                        まずはお気軽にご相談ください
                    </h2>
                    <p class="text-lg md:text-xl mt-4">
                        相談は無料。あなたに最適なサポートをご提案します。
                    </p>

                    <div class="flex flex-col md:flex-row justify-center gap-6 mt-8">
                        <!-- 「業務内容を選んで相談する」ボタン -->
                        <a href="{{ route('consultations.chooseCategory') }}"
                        class="px-6 py-3 bg-white text-blue-500 font-semibold rounded-full text-lg shadow-lg border border-white transition hover:bg-gray-100">
                            業務内容を選んで相談する
                        </a>

                        <!-- 「専門家に相談する」ボタン -->
                        <a href="{{ route('consultations.chooseExpert') }}"
                        class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-full text-lg shadow-lg transition hover:bg-orange-600">
                            専門家に相談する
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


        </div>
    </div>

</body>
</html>

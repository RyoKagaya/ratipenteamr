<section class="w-full bg-white py-16 text-center">
    <div class="container mx-auto">
        <h3 class="text-3xl text-blue-500 font-bold">ラティオでできること</h3>
        <p class="mt-4 text-lg text-gray-700">
            経理・財務・労務の専門家が、バックオフィスから貴社の成長をサポートします。
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 text-center">
            @foreach ([
                '仕訳・記帳代行' => '会計のプロが、取引内容を正しく分類し、日々の帳簿を作成。月次決算のスピードを向上させます。',
                '資金調達サポート' => '融資・補助金・助成金の申請、投資家向けの財務資料作成など、成長資金の確保をサポートします。',
                '労務・給与計算' => '社会保険手続き、給与計算、勤怠管理など、人事労務の専門家が正確に処理します。',
                '契約・法務サポート' => '契約書の作成・レビュー、契約管理など、企業のリスクを最小限に抑える法務サポートを提供します。',
                'デザイン関連' => '投資家向け資料のデザイン、ブランディング強化、営業資料のブラッシュアップを支援します。',
                'その他' => '個別ニーズに応じたカスタマイズ支援や、バックオフィスの改善提案を行います。',
            ] as $title => $description)
                <div class="relative p-6 bg-white text-gray-900 border-2 border-blue-500 rounded-lg shadow-md flex flex-col items-center">
                    <div class="absolute top-0 -translate-y-1/2 bg-blue-500 text-white text-md font-semibold px-4 py-1 rounded-full border border-blue-500 shadow">
                        {{ $title }}
                    </div>
                    <p class="mt-3 text-sm text-gray-700">
                        {{ $description }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

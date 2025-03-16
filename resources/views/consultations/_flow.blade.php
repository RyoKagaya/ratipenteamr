<section class="w-full text-center py-24 bg-blue-50 border-t border-gray-200 mt-16">
    <div class="container mx-auto">
        <h3 class="text-3xl font-bold">ご相談の流れ</h3>
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 mt-8">
            @foreach ([
                ['相談内容を選ぶ', 'flow_step1.png', '「業務内容」または「専門家」から相談内容を選択'],
                ['ヒアリング', 'flow_step2.png', 'お悩みや業務課題を専門スタッフが詳しくヒアリング'],
                ['最適なサポート提案', 'flow_step3.png', 'ヒアリング内容をもとに、あなたの課題に最適なプランをご提案']
            ] as $step)
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 flex flex-col items-center w-full md:w-80">
                    <h4 class="text-xl font-semibold">{{ $step[0] }}</h4>
                    <img src="/img/{{ $step[1] }}" alt="{{ $step[0] }}" class="h-32 w-32 rounded-full object-cover mx-auto my-4">
                    <p class="text-gray-600 mt-2">{{ $step[2] }}</p>
                </div>

                @if (!$loop->last)
                    <div class="hidden md:flex items-center justify-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

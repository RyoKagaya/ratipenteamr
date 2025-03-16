<section class="w-full bg-blue-50 py-16 flex justify-center">
    <div class="w-[80%] md:w-[70%] bg-blue-500 text-white text-center py-12 px-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl md:text-3xl font-bold">
            まずはお気軽にご相談ください
        </h2>
        <p class="text-lg md:text-xl mt-4">
            相談は無料。あなたに最適なサポートをご提案します。
        </p>

        <div class="flex flex-col md:flex-row justify-center gap-6 mt-8">
            <a href="{{ route('consultations.choose-category') }}"
                class="px-6 py-3 bg-white text-blue-500 font-semibold rounded-full text-lg shadow-lg border border-white transition hover:bg-gray-100">
                業務内容を選んで相談する
            </a>
            <a href="{{ route('consultations.choose-expert') }}"
                class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-full text-lg shadow-lg transition hover:bg-orange-600">
                専門家に相談する
            </a>
        </div>
    </div>
</section>

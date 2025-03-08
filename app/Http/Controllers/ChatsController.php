<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChatsController extends Controller
{
    public function index()
    {
        return view('chats.index'); // 初期画面
    }

    public function talk(Request $request): JsonResponse
    {
        $userMessage = $request->input('user_message');

        // ラティペンの仮の応答
        $responses = [
            "そのご質問であれば、ラティオで解決できるかもしれないです！ラティオの加賀屋さんに相談しますか？🐧",
            "減資の目的（欠損補填、自己資本の適正化、税務メリットの活用など）によって適切な相談相手が変わるので、まずは公認会計士または税理士に相談し、具体的な手続きの流れを整理したうえで、弁護士・司法書士などの専門家に依頼するのがよいでしょう。そのご質問には、専門家の意見が必要です！まずは、税理士の大川さんに相談しますか？🐧",
            "リンクスペイシーズの門田さんへのご請求ですね。いつもの金額・取引内容で請求書を作成しておきました。こちらからご確認いただけます🐧https://invoice.moneyforward.com/billings"
        ];

        // ランダムな応答を選択
        $botReply = $responses[array_rand($responses)];

        return response()->json(['reply' => $botReply], 200, [], JSON_UNESCAPED_UNICODE);
    }

}

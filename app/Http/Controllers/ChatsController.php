<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ChatsController extends Controller
{
    public function talk(Request $request): JsonResponse
    {
        $userMessage = $request->input('user_message');
        $conversationId = Session::get('conversation_id', null);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer app-SAhzb5K46Ymmdybwb65EJymd',
            'Content-Type' => 'application/json',
        ])->post('https://api.dify.ai/v1/chat-messages', [
            'inputs' => ['freee_token' => '0', 'service_provider' => ''],
            'query' => $userMessage,
            'response_mode' => 'blocking',
            'user' => 'ratio',
            'conversation_id' => $conversationId, // 🟢 連続会話を実現
        ]);

        $responseData = $response->json();
        $botReply = $responseData['answer'] ?? 'エラーが発生しました。';

        if (!empty($responseData['conversation_id'])) {
            Session::put('conversation_id', $responseData['conversation_id']);
        }

        return response()->json([
            'reply' => $botReply,
            'conversation_id' => $responseData['conversation_id'] ?? null,
        ]);
    }

}

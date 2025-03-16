<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditTransaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CreditController extends Controller
{
    public function purchaseCredits(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:5|max:100',
        ]);

        // 5クレジット単位でのみ購入可能
        if ($request->amount % 5 !== 0) {
            return response()->json(['success' => false, 'message' => '5クレジット単位で購入してください。'], 400);
        }

        $user = Auth::user();

        // ユーザーの現在のクレジット
        $currentCredits = $user->credits;

        // 最大100クレジットまでの制限
        if ($currentCredits + $request->amount > 100) {
            return response()->json(['success' => false, 'message' => 'クレジットは最大100までしか購入できません。'], 400);
        }

        // クレジット追加
        $user->credits += $request->amount;
        $user->save();

        // 購入履歴を保存
        CreditTransaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => 'credit_addition',
            'description' => "クレジット購入 ({$request->amount} クレジット)"
        ]);

        return response()->json([
            'success' => true,
            'newCredits' => $user->credits
        ]);
    }
}

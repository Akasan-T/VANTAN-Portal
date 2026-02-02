<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QrToken;

class ScanController extends Controller
{
    public function handle(Request $request)
    {
        $token = $request->input('token');

        $qr = QrToken::where('token', $token)->first();

        if (!$qr) {
            return response()->json(['success' => false, 'message' => '無効なトークンです'], 404);
        }

        // ここでユーザーやポイント加算処理を実装（仮にUser::find(1)に付与する例）
        $user = \App\Models\User::find(1);
        $user->point += $qr->point;
        $user->save();

        // トークン再利用不可にしたいなら削除またはフラグを立てる
        $qr->delete();

        return response()->json(['success' => true, 'point' => $qr->point]);
    }
}
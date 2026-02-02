<?php
use Illuminate\Http\Request;
use App\Models\QrToken;
use App\Http\Controllers\Api\ScanController;

Route::post('/scan', function (Request $request) {
    $request->validate(['token' => 'required|uuid']);

    $qr = QrToken::where('token', $request->token)->first();

    Route::post('/scan', [ScanController::class, 'store']);

    if (!$qr) {
        return response()->json(['message' => '無効なトークンです'], 404);
    }

    if ($qr->used_at) {
        return response()->json(['message' => 'このトークンは既に使用されています'], 410);
    }

    // トークン使用マーク
    $qr->used_at = now();
    $qr->save();

    // ポイント加算処理（本来はユーザーと紐づけて行う）
    return response()->json([
        'message' => 'ポイント付与しました',
        'point' => $qr->point,
        'level' => $qr->level,
    ]);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// テスト用（後で削除）
Route::get('/test', function () {
    return response()->json([
        'message' => 'API OK'
    ]);
});

// ログイン
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    // 全ロール共通
    Route::get('/me', [AuthController::class, 'me']);

    // 教師のみ
    Route::middleware('role:teacher')->group(function () {

    });

    // 教師側(認証必須)
    Route::middleware('role:teacher')->group(function () {

    });
});
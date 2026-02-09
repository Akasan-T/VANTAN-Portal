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

    // 生徒側(認証必須)
    Route::get('/me', [AuthController::class, 'me']);

    // スタッフ側(認証必須)
    // filament使用だから必要か分かんない
    // Route::middleware('role:staff')->group(function () {
        
    // });

    // 教師側(認証必須)
    Route::middleware('role:teacher')->group(function () {

    });
});
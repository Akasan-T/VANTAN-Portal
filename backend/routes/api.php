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
Route::get('/me', [AuthController::class, 'me']);
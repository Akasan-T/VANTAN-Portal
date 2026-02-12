<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Student\AttendanceController;

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

    // 学生(認証必須)
    Route::prefix('/student')->middleware('role:student')->group(function () {
        // QR出席
        Route::post('/attendance/check', [AttendanceController::class, 'check']);
        Route::post('/attendance/store', [AttendanceController::class, 'store']);
        Route::get('/attendance/today', [AttendanceController::class, 'today']);
    });

    // 教師(認証必須)
    Route::middleware('role:teacher')->group(function () {
        // 一旦後回し
    });
});
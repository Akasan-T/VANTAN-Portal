<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\UserController; // ✅ これを忘れずに

Route::get('/', function () {
    return view('welcome');
});

Route::get('/camera', function () {
    return view('camera');
});

Route::post('/camera/upload', [CameraController::class, 'upload'])->name('camera.upload');

Route::get('/user/{id}', [UserController::class, 'show']); 

Route::get('/qr/{uuid}', [UserController::class, 'showByQR']);
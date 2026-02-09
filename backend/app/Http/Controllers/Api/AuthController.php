<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 仮:後でSanctum認証に差し替え
        $user = User::where('email ', 'admin@example.com')->first();

        if (!$user) {
            return response()->json(['message' => 'ユーザーが見つかりません'], 404);
        }

        return response()->json([
            'token' => 'dummy-token',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function me()
    {
        // 仮:後で差し替え
        return response()->json([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
    }
}

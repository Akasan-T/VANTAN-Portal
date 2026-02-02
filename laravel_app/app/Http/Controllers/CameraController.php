<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class CameraController extends Controller
{
    public function upload(Request $request)
    {
        $data = $request->input('image');

        // base64から画像に変換して保存
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $data = base64_decode($data);
            $extension = $type[1];
            $filename = uniqid() . '.' . $extension;
            Storage::disk('public')->put("uploads/{$filename}", $data);
            return back()->with('success', 'アップロード成功: ' . $filename);
        }

        return back()->with('error', 'アップロード失敗');
    }

    public function show($id)
    {
    $user = User::findOrFail($id);
    return view('user.show', compact('user'));
    }
}
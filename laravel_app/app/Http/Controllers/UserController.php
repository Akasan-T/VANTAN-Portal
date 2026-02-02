<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function showByQR($uuid)
    {
    $user = User::where('qr_uuid', $uuid)->firstOrFail();
    return view('user.show', compact('user'));
    }
}
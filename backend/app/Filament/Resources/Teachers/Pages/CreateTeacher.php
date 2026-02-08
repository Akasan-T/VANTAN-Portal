<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Resources\Teachers\TeacherResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // User 作成
        $user = User::create([
            'name'      => $data['user']['name'],
            'email'     => $data['user']['email'],
            'password'  => Hash::make($data['password']),
            'role'      => 'teacher',
            'is_active' => $data['user']['is_active'] ?? true,
        ]);

        // Teacher に user_id を紐付け
        $data['user_id'] = $user->id;

        // 不要なデータを削除
        unset($data['user'], $data['password']);

        return $data;
    }
}
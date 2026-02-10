<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Models\Teacher;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = \App\Filament\Resources\Teachers\TeacherResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = \App\Models\User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
            'role'     => 'teacher',
        ]);

        return [
            'user_id'   => $user->id,
            'specialty' => $data['specialty'] ?? null,
        ];
    }
}
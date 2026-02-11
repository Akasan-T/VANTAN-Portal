<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Resources\Teachers\TeacherResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;

    // app/Filament/Resources/Teachers/Pages/CreateTeacher.php

protected function mutateFormDataBeforeCreate(array $data): array
{
    // 🔍 修正：ここで一度中身を止めて確認してください
    // dd($data); 

    // 1. パスワードの抽出
    $password = $data['password'] ?? null;

    if (!$password) {
        // もし dd($data) で 'user' => ['password' => '...'] となっていたらこちら
        $password = $data['user']['password'] ?? null;
    }

    return DB::transaction(function () use ($data, $password) {
        // 2. User 作成
        $user = User::create([
            'name'     => $data['user']['name'],
            'email'    => $data['user']['email'],
            'password' => Hash::make($password),
            'role'     => 'teacher',
        ]);

        // 3. Teacherテーブルに保存するデータのみを返す
            return [
                'user_id'   => $user->id,
                'specialty' => $data['specialty'] ?? null,
            ];
        });
    }
}
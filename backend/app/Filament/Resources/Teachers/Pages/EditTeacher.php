<?php
namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Resources\Teachers\TeacherResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;

    public function getTitle(): string 
    {
        return '講師情報編集';
    }

    protected function getRedirectUrl(): string
    {
        // 保存したら一覧画面に戻る
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return DB::transaction(function () use ($data) {
            // パスワードがどこにあるかチェック（userの中にあるか、直下にあるか）
            $password = $data['password'] ?? ($data['user']['password'] ?? null);

            // 1. User 作成
            $user = User::create([
                'name'     => $data['user']['name'],
                'email'    => $data['user']['email'],
                'password' => Hash::make($password), // 修正後の変数を使用
                'role'     => 'teacher',
            ]);

            // 2. Teacher に渡すデータを整形
            return [
                'user_id'   => $user->id,
                'specialty' => $data['specialty'] ?? null,
            ];
        });
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = $this->record->user;
        // 編集画面を開いた時に、Userテーブルの値をフォームにセットする
        $data['user']['name']  = $this->record->user->name;
        $data['user']['email'] = $this->record->user->email;

        return [
            'specialty' =>$data['specialty'] ?? null,
        ];
    }
}
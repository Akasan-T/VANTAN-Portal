<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Resources\Teachers\TeacherResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Filament\Actions\Action; // 👈 追加

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;

    public function getTitle(): string 
    {
        return '講師アカウントの作成';
    }

    /**
     * ボタンの日本語化と制御
     */
    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('登録する');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        // 「登録して続けて作成」ボタンを非表示にする
        return parent::getCreateAnotherFormAction()
            ->hidden();
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('キャンセル');
    }

    /**
     * 登録成功時の通知メッセージ
     */
    protected function getCreatedNotificationTitle(): ?string
    {
        return '講師を登録しました';
    }

    /**
     * 登録後のリダイレクト先を一覧画面にする
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * 保存処理（既存のロジック）
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $password = $data['password'] ?? ($data['user']['password'] ?? null);

        return DB::transaction(function () use ($data, $password) {
            $user = User::create([
                'name'     => $data['user']['name'],
                'email'    => $data['user']['email'],
                'password' => Hash::make($password),
                'role'     => 'teacher',
            ]);

            return [
                'user_id'   => $user->id,
                'specialty' => $data['specialty'] ?? null,
            ];
        });
    }
}
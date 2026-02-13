<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Resources\Teachers\TeacherResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;

    public function getTitle(): string 
    {
        // $this->record で編集中のデータにアクセス
        return $this->record->user->name . ' 講師の情報を編集';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * 保存後のリダイレクト先
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * 保存処理のカスタマイズ
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // 1. 現在編集中の講師(Teacher)に紐づくユーザーを取得
        $user = $this->record->user;

        DB::transaction(function () use ($data, $user) {
            // 2. ユーザーテーブルを更新
            $updateData = [
                'name'  => $data['user']['name'],
                'email' => $data['user']['email'],
            ];

            // パスワードが入力されている場合のみ更新する
            if (!empty($data['user']['password'])) {
                $updateData['password'] = Hash::make($data['user']['password']);
            }

            $user->update($updateData);
        });

        // 3. 講師テーブル(specialtyなど)に保存するデータだけを返却
        return [
            'specialty' => $data['specialty'] ?? null,
        ];
    }
}
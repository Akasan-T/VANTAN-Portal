<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;

    /**
     * ページのメインタイトル
     */
    public function getTitle(): string 
    {
        return '教室の登録';
    }

    /**
     * 登録成功後のリダイレクト先（一覧画面）
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * 「登録」ボタンのカスタマイズ
     */
    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('登録する');
    }

    /**
     * 「登録して続けて作成」ボタンを非表示にする
     */
    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->hidden();
    }

    /**
     * 「キャンセル」ボタンのラベル
     */
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('キャンセル');
    }
}
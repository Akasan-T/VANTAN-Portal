<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRooms extends ListRecords
{
    protected static string $resource = RoomResource::class;

    /**
     * ページのメインタイトル
     */
    public function getTitle(): string 
    {
        return '教室一覧';
    }

    /**
     * 画面右上のアクションボタン（新規登録ボタン）
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('教室を登録する'),
        ];
    }
}
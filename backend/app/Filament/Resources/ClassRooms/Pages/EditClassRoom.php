<?php

namespace App\Filament\Resources\ClassRooms\Pages;

use App\Filament\Resources\ClassRooms\ClassRoomResource;
use Filament\Resources\Pages\EditRecord;

class EditClassRoom extends EditRecord
{
    protected static string $resource = ClassRoomResource::class;

    // タイトルを「授業の編集」に変更
    public function getTitle(): string 
    {
        return '授業の編集';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            // 必要なら削除ボタンなど
        ];
    }
}
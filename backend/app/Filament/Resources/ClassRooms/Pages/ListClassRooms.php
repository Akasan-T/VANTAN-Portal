<?php

namespace App\Filament\Resources\ClassRooms\Pages;

use App\Filament\Resources\ClassRooms\ClassRoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassRooms extends ListRecords
{
    protected static string $resource = ClassRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // これを追加すると「登録」ボタンが出現します
            Actions\CreateAction::make()
                ->label('授業を登録する'),
        ];
    }

    public function getTitle(): string 
    {
        return '授業管理';
    }
}

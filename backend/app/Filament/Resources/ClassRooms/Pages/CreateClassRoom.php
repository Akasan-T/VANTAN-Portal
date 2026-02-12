<?php

namespace App\Filament\Resources\ClassRooms\Pages;

use App\Filament\Resources\ClassRooms\ClassRoomResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClassRoom extends CreateRecord
{
    protected static string $resource = ClassRoomResource::class;

    // タイトルを「授業の登録」に変更
    public function getTitle(): string 
    {
        return '授業の登録';
    }
}
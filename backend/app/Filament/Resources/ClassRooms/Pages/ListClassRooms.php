<?php

namespace App\Filament\Resources\ClassRooms\Pages;

use App\Filament\Resources\ClassRooms\ClassRoomResource;
use Filament\Resources\Pages\ListRecords;

class ListClassRooms extends ListRecords
{
    protected static string $resource = ClassRoomResource::class;

    public function getTitle(): string 
    {
        return '授業一覧';
    }
}

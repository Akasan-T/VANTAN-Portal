<?php

namespace App\Filament\Resources\ClassRooms\Pages;

use App\Filament\Resources\ClassRooms\ClassRoomResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateClassRoom extends CreateRecord
{
    protected static string $resource = ClassRoomResource::class;

    public function getTitle(): string 
    {
        return '授業の登録';
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('登録する');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->hidden(); // これでボタンが消えます
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('キャンセル');
    }
}
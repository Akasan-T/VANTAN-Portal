<?php

namespace App\Filament\Resources\ClassRooms\Schemas;

use Filament\Forms\Components\TextInput;

class ClassRoomForm
{
    public static function configure($form)
    {
        return $form
            ->schema([
                TextInput::make('class_name')
                    ->label('クラス名')
                    ->required(),

                TextInput::make('floor')
                    ->label('フロア')
                    ->placeholder('例: 2F')
                    ->required(),

                TextInput::make('capacity')
                    ->label('最大座席数')
                    ->numeric()
                    ->placeholder('例: 30')
                    ->required(),
            ]);
    }
}
<?php

namespace App\Filament\Resources\ClassRooms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class ClassRoomInfolist
{
    public static function configure($form)
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('教室名 / クラス名')
                    ->required(),

                TextInput::make('floor')
                    ->label('フロア')
                    ->placeholder('例：3F')
                    ->required(),

                TextInput::make('capacity')
                    ->label('最大座席数')
                    ->numeric()
                    ->required(),

                // 講師は「任意」にする（requiredを外す）
                Select::make('teacher_id')
                    ->label('デフォルト担当講師（任意）')
                    ->relationship('teacher', 'name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                    ->placeholder('未定')
                    ->searchable()
                    ->preload(), 
            ]);
    }
}
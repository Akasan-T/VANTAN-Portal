<?php

namespace App\Filament\Resources\RoomResource\Forms;

use Filament\Schemas\Schema; // 👈 ここも Schema に変更
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;

class RoomForm
{
    /**
     * 引数と戻り値の型を Schema に合わせます
     */
    public static function configure(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('教室基本情報')
                    ->schema([
                        TextInput::make('room_name')
                            ->label('教室名')
                            ->required(),
                        
                        TextInput::make('floor')
                            ->label('階数')
                            ->numeric()
                            ->required(),

                        TextInput::make('capacity')
                            ->label('収容人数')
                            ->numeric()
                            ->required()
                            ->suffix('名'),
                    ])->columns(2),
            ]);
    }
}
<?php

namespace App\Filament\Resources\RoomResource\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class RoomsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->emptyStateHeading('教室が登録されていません')
            ->columns([
                TextColumn::make('room_name')
                    ->label('教室名')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('floor')
                    ->label('階数')
                    ->suffix('階')
                    ->sortable(),

                TextColumn::make('capacity')
                    ->label('収容人数')
                    ->suffix('名')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('登録日')
                    ->dateTime('Y/m/d H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
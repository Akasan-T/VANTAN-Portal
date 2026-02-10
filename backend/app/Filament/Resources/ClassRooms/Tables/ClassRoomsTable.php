<?php

namespace App\Filament\Resources\ClassRooms\Tables;

use Filament\Tables;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;


class ClassRoomsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->emptyStateHeading('教室が登録されていません')
            ->emptyStateDescription('右上の「新規作成」から教室を追加できます。')
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

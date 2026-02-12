<?php

namespace App\Filament\Resources\ClassRooms;

use App\Filament\Resources\ClassRooms\Pages\CreateClassRoom;
use App\Filament\Resources\ClassRooms\Pages\EditClassRoom;
use App\Filament\Resources\ClassRooms\Pages\ListClassRooms;
use App\Filament\Resources\ClassRooms\Pages\ViewClassRoom;
use App\Filament\Resources\ClassRooms\Schemas\ClassRoomForm;
use App\Filament\Resources\ClassRooms\Schemas\ClassRoomInfolist;
use App\Filament\Resources\ClassRooms\Tables\ClassRoomsTable;
use App\Models\Classes;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClassRoomResource extends Resource
{
    protected static ?string $model = Classes::class;

    protected static ?string $navigationLabel = '授業管理';
    protected static ?string $modelLabel = '授業';
    protected static ?string $pluralModelLabel = '授業';
    protected static ?string $slug = 'classes';

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $recordTitleAttribute = 'PHP';

    public static function form(Schema $schema): Schema
    {
        return ClassRoomForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ClassRoomInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClassRoomsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClassRooms::route('/'),
            'create' => CreateClassRoom::route('/create'),
            'edit' => EditClassRoom::route('/{record}/edit'),
        ];
    }
}


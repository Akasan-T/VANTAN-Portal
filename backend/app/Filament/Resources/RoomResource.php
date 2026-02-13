<?php

namespace App\Filament\Resources;

use BackedEnum;
use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\Tables\RoomsTable; // ← 追加
use App\Models\Room;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationLabel = '教室管理';

    // パンくず日本語化
    protected static ?string $modelLabel = '教室';
    protected static ?string $pluralModelLabel = '教室';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('room_name')
                    ->label('教室名')
                    ->required(),

                Forms\Components\TextInput::make('floor')
                    ->label('階数')
                    ->numeric(),

                Forms\Components\TextInput::make('capacity')
                    ->label('収容人数')
                    ->numeric(),
            ]);
    }

    // 👇 ここを整理版に変更
    public static function table(Table $table): Table
    {
        return RoomsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
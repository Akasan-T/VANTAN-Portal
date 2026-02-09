<?php

namespace App\Filament\Resources\Teachers;

use App\Models\Teacher;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms;
use App\Filament\Resources\Teachers\Pages;
use Filament\Support\Icons\Heroicon;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static \BackedEnum|string|null $navigationIcon = Heroicon::AcademicCap;
    protected static ?string $navigationLabel = '講師管理';
    protected static ?string $modelLabel = '講師';
    protected static ?string $pluralModelLabel = '講師';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([

            Forms\Components\TextInput::make('name')
                ->label('名前')
                ->required(),

            Forms\Components\TextInput::make('email')
                ->label('メールアドレス')
                ->email()
                ->required(),

            Forms\Components\TextInput::make('password')
                ->label('初期パスワード')
                ->password()
                ->required(),

            Forms\Components\TextInput::make('specialty')
                ->label('担当科目'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit'   => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
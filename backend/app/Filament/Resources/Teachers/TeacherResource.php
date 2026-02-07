<?php

namespace App\Filament\Resources\Teachers;

use App\Models\Teacher;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms;
use Illuminate\Support\Facades\Hash;

// ★ ここ重要（修正点）
use App\Filament\Resources\Teachers\Pages;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-academic-cap';

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
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('subject')
                ->label('担当科目'),

            Forms\Components\TextInput::make('password')
                ->label('パスワード')
                ->password()
                ->required(fn ($record) => $record === null)
                ->dehydrateStateUsing(
                    fn ($state) => filled($state) ? Hash::make($state) : null
                )
                ->dehydrated(fn ($state) => filled($state)),

            Forms\Components\Toggle::make('is_active')
                ->label('在籍中')
                ->default(true),
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
<?php

namespace App\Filament\Resources\Teachers;

use App\Models\Teacher;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms;
use Illuminate\Support\Facades\Hash;
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

            /* ===== User 情報 ===== */

            Forms\Components\TextInput::make('user.name')
                ->label('名前')
                ->required(),

            Forms\Components\TextInput::make('user.email')
                ->label('メールアドレス')
                ->email()
                ->required(),

            Forms\Components\TextInput::make('password')
                ->label('初期パスワード')
                ->password()
                ->required(fn ($record) => $record === null)
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(false), // Teacherには保存しない

            Forms\Components\Toggle::make('user.is_active')
                ->label('在籍中')
                ->default(true),

            /* ===== Teacher 情報 ===== */

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
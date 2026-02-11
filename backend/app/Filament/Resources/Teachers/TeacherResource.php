<?php

namespace App\Filament\Resources\Teachers;

use App\Models\Teacher;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; 
use Filament\Forms;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\Teachers\Pages;
use App\Filament\Resources\Teachers\Tables\TeachersTable;
use Filament\Support\Icons\Heroicon;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static \BackedEnum|string|null $navigationIcon = Heroicon::AcademicCap;
    protected static ?string $navigationLabel = '講師管理';
    protected static ?string $modelLabel = '講師';
    protected static ?string $pluralModelLabel = '講師';

    /**
     * 入力フォームの定義
     * エラーを避けるため、Section や Grid を使わずにフラットな構成にします
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            // User情報
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
                ->required(fn ($livewire) => $livewire instanceof Pages\CreateTeacher)
                ->dehydrated(true), 

            Forms\Components\Toggle::make('user.is_active')
                ->label('在籍中')
                ->default(true),

            // Teacher情報
            Forms\Components\TextInput::make('specialty')
                ->label('担当科目'),
        ]);
    }

    /**
     * 一覧画面の定義
     */
    public static function table(Table $table): Table
    {
        // TeachersTable::configure が Table クラスを受け取る設定になっているか確認してください
        return TeachersTable::configure($table);
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
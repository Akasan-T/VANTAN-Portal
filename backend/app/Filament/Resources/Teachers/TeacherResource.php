<?php

namespace App\Filament\Resources\Teachers;

use App\Models\Teacher;
use Filament\Resources\Resource;
use Filament\Resources\Form; // v2/互換モードの場合はこちらが必要なことがあります
use Filament\Resources\Table; // 同上
use Filament\Schemas\Schema; // エラーメッセージが求めているクラス
use Filament\Tables\Table as FilamentTable; // Tableクラスの衝突回避
use Filament\Forms;
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
     * 引数を Schema $schema に戻し、戻り値の型指定を外して互換性を優先します
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            /* ===== User 情報 ===== */
            Forms\Components\Section::make('ログイン情報')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('user.name')
                            ->label('名前')
                            ->required(),

                        Forms\Components\TextInput::make('user.email')
                            ->label('メールアドレス')
                            ->email()
                            ->required(),
                    ]),

                    Forms\Components\TextInput::make('password')
                        ->label('初期パスワード')
                        ->password()
                        ->required(fn ($livewire) => $livewire instanceof Pages\CreateTeacher)
                        ->dehydrated(true), 

                    Forms\Components\Toggle::make('user.is_active')
                        ->label('在籍中')
                        ->default(true),
                ]),

            /* ===== Teacher 情報 ===== */
            Forms\Components\Section::make('講師詳細')
                ->schema([
                    Forms\Components\TextInput::make('specialty')
                        ->label('担当科目'),
                ]),
        ]);
    }

    /**
     * 一覧画面の定義
     */
    public static function table(FilamentTable $table): FilamentTable
    {
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
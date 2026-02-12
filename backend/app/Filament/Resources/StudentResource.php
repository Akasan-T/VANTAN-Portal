<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    public static function getNavigationLabel(): string
    {
        return '生徒管理';
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-user-group';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. 名前を直接入力できるようにします
                TextInput::make('name')
                    ->label('氏名')
                    ->required(),

                // 2. ユーザーIDの入力欄を「隠しフィールド」にします
                // 生徒を保存する際、自動でUserを作成してIDをセットします
                // \Filament\Forms\Components\Hidden::make('user_id')
                //     ->default(0), // 仮の値。保存直前に書き換えます

                TextInput::make('student_number')
                    ->label('学籍番号')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('faculty')
                    ->label('学部')
                    ->required(),

                TextInput::make('department')
                    ->label('学科')
                    ->required(),

                TextInput::make('major')
                    ->label('専攻')
                    ->required(),

                TextInput::make('grade')
                    ->label('学年')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->required(),

                TextInput::make('enrollment_year')
                    ->label('入学年度')
                    ->numeric()
                    ->default(date('Y'))
                    ->required(),

                Select::make('status')
                    ->label('学籍状態')
                    ->options([
                        'enrolled' => '在学',
                        'on_leave' => '休学',
                        'expelled' => '除籍',
                        'graduated' => '卒業',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('氏名')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('student_number')
                    ->label('学籍番号')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('grade')
                    ->label('学年')
                    ->sortable(),

                TextColumn::make('faculty')
                    ->label('学部')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('状態')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'enrolled' => 'success',
                        'on_leave' => 'warning',
                        'expelled' => 'danger',
                        'graduated' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'enrolled' => '在学',
                        'on_leave' => '休学',
                        'expelled' => '除籍',
                        'graduated' => '卒業',
                        default => $state,
                    }),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
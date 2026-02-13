<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; // v4の型
use Filament\Tables\Table;   // v4の型
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

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

    // 引数の型を Schema に統一
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('氏名')
                    ->required(),

                TextInput::make('student_number')
                    ->label('学籍番号')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('faculty')->label('学部')->required(),
                TextInput::make('department')->label('学科')->required(),
                TextInput::make('major')->label('専攻')->required(),

                TextInput::make('grade')
                    ->label('学年')
                    ->numeric()
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

    // 引数の型を Table に統一
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('氏名')->sortable()->searchable(),
                TextColumn::make('student_number')->label('学籍番号')->sortable()->searchable(),
                TextColumn::make('grade')->label('学年')->sortable(),
                TextColumn::make('faculty')->label('学部')->searchable(),
                TextColumn::make('status')
                    ->label('状態')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'enrolled' => 'success',
                        'on_leave' => 'warning',
                        'expelled' => 'danger',
                        'graduated' => 'gray',
                        default => 'gray',
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
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    // 型宣言 (?string) を外して、親クラスとの競合を避けます
    protected static $navigationLabel = '生徒管理';
    protected static $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                TextColumn::make('name')->label('氏名')->sortable()->searchable(),
                TextColumn::make('student_number')->label('学籍番号')->sortable()->searchable(),
                TextColumn::make('grade')->label('学年')->sortable(),
                TextColumn::make('faculty')->label('学部')->searchable(),
                TextColumn::make('department')->label('学科'),
                TextColumn::make('major')->label('専攻'),
                TextColumn::make('enrollment_year')->label('入学年度')->sortable(),
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
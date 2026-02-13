<?php

namespace App\Filament\Resources\ClassRooms\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ClassRoomsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->emptyStateHeading('授業が登録されていません')
            ->columns([
                TextColumn::make('class_name')
                    ->label('授業名')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('department_name')
                    ->label('対象学科')
                    ->searchable(),

                TextColumn::make('grade')
                    ->label('学年')
                    ->suffix('年生')
                    ->sortable(),

                // ★ ここに担当講師を追加
                TextColumn::make('teacher.name')
                    ->label('担当講師')
                    ->placeholder('未定') // 講師が紐付いていない場合に表示
                    ->searchable(),

                TextColumn::make('school_year')
                    ->label('年度')
                    ->sortable(),

                TextColumn::make('term')
                    ->label('学期')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'first' => '前期',
                        'second' => '後期',
                        'year' => '通年',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'first' => 'info',
                        'second' => 'warning',
                        'year' => 'success',
                        default => 'gray',
                    }),
            ]);
    }
}
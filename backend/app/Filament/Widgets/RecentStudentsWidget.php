<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Student;

class RecentStudentsWidget extends BaseWidget
{
    protected static ?string $heading = '最近登録された生徒';
    protected static ?int $sort = 2; // 統計の下に並べる
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Student::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('氏名'),
                Tables\Columns\TextColumn::make('student_number')->label('学籍番号'),
                Tables\Columns\TextColumn::make('grade')->label('学年'),
                Tables\Columns\TextColumn::make('status')
                    ->label('状態')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'enrolled' => 'success',
                        'on_leave' => 'warning',
                        default => 'gray',
                    }),
            ])
            // 行全体をクリックできるようにして、エラーの出やすい「Action」を回避します
            ->recordUrl(
                fn (Student $record): string => "/admin/students/{$record->id}/edit"
            );
    }
}
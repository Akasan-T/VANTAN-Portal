 <?php

// namespace App\Filament\Widgets;

// use Filament\Widgets\TableWidget as BaseWidget;
// use Filament\Tables;
// use Illuminate\Database\Eloquent\Builder;
// use App\Models\ClassRoom;

// class TodayClasses extends BaseWidget

//     protected static ?string $heading = '今日の授業';

//     protected function getTableColumns(): array
//     {
//         return [
//             Tables\Columns\TextColumn::make('class_name')->label('授業名'),
//             Tables\Columns\TextColumn::make('teacher_name')->label('教員'),
//             Tables\Columns\TextColumn::make('period')->label('時限'),
//             Tables\Columns\TextColumn::make('room')->label('教室'),
//             Tables\Columns\TextColumn::make('status')->label('出席状況'),
//         ];
//     }

//     protected function getTableQuery(): Builder
//     {
//         return ClassRoom::query()->whereRaw('1 = 0');
//     }
// } 
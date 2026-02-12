<?php

namespace App\Filament\Resources\ClassRooms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class ClassRoomForm
{
    public static function configure($form)
    {
        return $form
            ->schema([
                // 授業名
                TextInput::make('class_name')
                    ->label('授業名')
                    ->placeholder('例: Webプログラミング実習')
                    ->required(),

                // 学科名
                TextInput::make('department_name')
                    ->label('対象学科')
                    ->placeholder('例: ITカレッジ')
                    ->required(),

                // 学年
                TextInput::make('grade')
                    ->label('対象学年')
                    ->numeric()
                    ->placeholder('例: 1')
                    ->required(),

                // 年度
                TextInput::make('school_year')
                    ->label('実施年度')
                    ->numeric()
                    ->default(2026)
                    ->required(),

                // 学期（Enumに合わせてSelectにする）
                Select::make('term')
                    ->label('学期')
                    ->options([
                        'first' => '前期',
                        'second' => '後期',
                        'year' => '通年',
                    ])
                    ->required(),

                // 担当講師（マイグレーションで定義したteacher_id）
                Select::make('teacher_id')
                    ->label('担当講師')
                    ->relationship('teacher', 'name') // Teacherモデルとの紐付け
                    ->searchable()
                    ->preload()
                    ->nullable(), // 講師未定でもOKにする場合
            ]);
    }
}
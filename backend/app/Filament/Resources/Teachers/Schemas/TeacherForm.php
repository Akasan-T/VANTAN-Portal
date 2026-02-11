<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class TeacherForm
{
    public static function configure($form)
    {
        return $form
            ->schema([
                Section::make('ログイン情報')
                    ->description('講師のログインアカウントを作成します')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('user.name')
                                ->label('氏名')
                                ->required(),
                            TextInput::make('user.email')
                                ->label('メールアドレス')
                                ->email()
                                ->required(),
                        ]),
                        TextInput::make('user.password')
                            ->label('初期パスワード')
                            ->password()
                            // 作成時は必須、編集時は任意にするロジック
                            ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                            ->dehydrated(true)
                            ->live(),
                    ]),

                Section::make('講師詳細')
                    ->schema([
                        TextInput::make('specialty')
                            ->label('専門分野・担当科目')
                            ->placeholder('例：数学、英語'),
                    ]),
            ]);
    }
}
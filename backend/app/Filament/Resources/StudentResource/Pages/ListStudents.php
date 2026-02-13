<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    // ページタイトルを日本語に
    public function getTitle(): string
    {
        return '生徒一覧';
    }

    // ヘッダーに表示するアクション（ボタン）をカスタマイズ
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('新規登録'), // ボタンの文字を日本語に
        ];
    }
}
<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Student;
use App\Models\User;

class StudentStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('生徒数', Student::count())
                ->description('登録済み生徒の総数')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'), // 青色系

            Stat::make('ユーザー数', User::count())
                ->description('全ログインアカウント')
                ->descriptionIcon('heroicon-m-finger-print'),

            Stat::make('在学中の生徒', Student::where('status', 'enrolled')->count())
                ->description('現在アクティブな生徒')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'), // ★ここで緑色がつきます
        ];
    }
}
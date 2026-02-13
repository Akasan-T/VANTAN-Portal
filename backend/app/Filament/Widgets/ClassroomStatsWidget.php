<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Room; // Roomモデルを使用

class ClassroomStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1; // 時間(0)のすぐ下

    protected function getStats(): array
    {
        return [
            Stat::make('総教室数', Room::count() . ' 室')
                ->description('登録されている教室の総数')
                ->descriptionIcon('heroicon-m-home-modern')
                ->color('info'),

            Stat::make('総収容可能人数', Room::sum('capacity') . ' 名')
                ->description('全教室のキャパシティ合計')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('平均収容人数', round(Room::avg('capacity'), 1) . ' 名')
                ->description('1教室あたりの平均サイズ')
                ->color('secondary'),
        ];
    }
}
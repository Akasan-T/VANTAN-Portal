<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TodayDateTime extends Widget
{
    protected string $view = 'filament.widgets.today-date-time';

    protected static ?int $sort = 1;
}

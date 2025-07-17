<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\GlobalStatsWidget;

class GlobalStatistics extends Page
{
    protected static ?string $navigationGroup = 'Statistics';
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.global-statistics';

    protected function getHeaderWidgets(): array
    {
        return [
            GlobalStatsWidget::class,
        ];
    }
}

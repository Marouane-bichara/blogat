<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlogMonitoring extends BaseWidget
{
    protected static ?string $pollingInterval = '10s'; // Optional: Auto-refresh every 10 seconds

    protected function getStats(): array
    {
        return [
            Stat::make('Active Blogs', Article::where('status', 'published')->count())
                ->description('Currently published blogs')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Inactive Blogs', Article::whereIn('status', ['draft', 'exported'])->count())
                ->description('Draft or exported blogs')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make('Total Blogs', Article::count())
                ->description('All blogs in the system')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary'),
        ];
    }
}

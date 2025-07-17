<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DiskUsageWidget extends BaseWidget
{
    // Optional: auto refresh interval for dynamic data
    protected static ?string $pollingInterval = '10s';

    protected function getCards(): array
    {
        $diskTotal = disk_total_space('/');
        $diskFree = disk_free_space('/');
        $diskUsed = $diskTotal - $diskFree;

        $usedPercentage = round(($diskUsed / $diskTotal) * 100, 2);

        return [
            Card::make('Disk Space Used', $this->formatSize($diskUsed))
                ->description("Used: {$usedPercentage}%")
                ->color('warning'),

            Card::make('Disk Space Free', $this->formatSize($diskFree))
                ->description('Remaining Free Space')
                ->color('success'),

            Card::make('Total Disk Space', $this->formatSize($diskTotal))
                ->description('Total Capacity')
                ->color('primary'),
        ];
    }

    private function formatSize($bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen((string)$bytes) - 1) / 3);
        return sprintf("%.2f", $bytes / pow(1024, $factor)) . ' ' . $units[$factor];
    }
}

<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DiskUsage extends Page
{
    protected static string $view = 'filament.pages.disk-usage';

    protected static ?string $navigationIcon = 'heroicon-o-server'; 

     protected static ?string $navigationGroup = 'System';

    protected static ?string $navigationLabel = 'Disk Usage';

    protected static ?string $slug = 'disk-usage';

    public int $diskTotal;
    public int $diskFree;
    public int $diskUsed;
    public float $usedPercentage;

    public function mount(): void
    {
        $this->diskTotal = disk_total_space('/');
        $this->diskFree = disk_free_space('/');
        $this->diskUsed = $this->diskTotal - $this->diskFree;
        $this->usedPercentage = round(($this->diskUsed / $this->diskTotal) * 100, 2);
    }

    public function formatSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen((string)$bytes) - 1) / 3);
        return sprintf("%.2f", $bytes / pow(1024, $factor)) . ' ' . $units[$factor];
    }
}

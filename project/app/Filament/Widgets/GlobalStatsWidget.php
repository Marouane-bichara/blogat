<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\Invoice;
use App\Models\User;

class GlobalStatsWidget extends BaseWidget
{
    protected function getCards(): array
    {
        // Revenue (CA)
        $totalRevenue = Invoice::where('status', 'paid')->sum('amount');

        // Subscribers
        $subscribersCount = User::where('subscription_expires_at', '>', now())->count();

        // Active Users (last 30 days)
        $activeUsersCount = User::whereNotNull('last_login_at')
                                ->where('last_login_at', '>=', now()->subDays(30))
                                ->count();

        return [
            Card::make('Total Revenue (CA)', '$' . number_format($totalRevenue, 2))
                ->description('Total revenue from all paid invoices')
                ->color('success'),

            Card::make('Subscribers', $subscribersCount)
                ->description('Users with active subscriptions')
                ->color('primary'),

            Card::make('Active Users (30d)', $activeUsersCount)
                ->description('Users who logged in within the last 30 days')
                ->color('warning'),
        ];
    }
}

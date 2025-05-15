<?php

namespace App\Filament\Widgets;

use App\Models\Pengguna;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Data 7 hari terakhir
        $chartDays = collect(range(6, 0))->map(function ($daysAgo) {
            return Carbon::today()->subDays($daysAgo);
        });

        // Chart New Users
        $newUsersChart = $chartDays->map(function ($date) {
            return Pengguna::whereDate('created_at', $date)->count();
        })->toArray();

        // Chart Inactive Users 
        $inactiveUsersChart = $chartDays->map(function ($date) {
            return Pengguna::whereDate('created_at', '<=', $date)
                ->where('terakhir_login', '<', $date->copy()->subMonths(3))
                ->count();
        })->toArray();

        // Chart Total User
        $totalUsersChart = $chartDays->map(function ($date) {
            return Pengguna::whereDate('created_at', '<=', $date)->count();
        })->toArray();

        return [
            Stat::make('New Users', Pengguna::where('created_at', '>=', now()->subDays(7))->count())
                ->description('New users that have joined')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart($newUsersChart)
                ->color('success'),

            Stat::make('Inactive Users', Pengguna::where('terakhir_login', '<', now()->subMonths(3))->count())
                ->description('Users not active for 3+ months')
                ->descriptionIcon('heroicon-m-user-minus', IconPosition::Before)
                ->chart($inactiveUsersChart)
                ->color('danger'),

            Stat::make('Total Users', Pengguna::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-users', IconPosition::Before)
                ->chart($totalUsersChart)
                ->color('success'),
        ];
    }
}

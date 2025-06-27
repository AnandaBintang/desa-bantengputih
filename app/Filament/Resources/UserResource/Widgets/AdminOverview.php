<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Get first non-super_admin user
        $admin = User::where('role', '!=', 'super_admin')
            ->orWhereNull('role')
            ->first();

        if (!$admin) {
            return [
                Stat::make('Status Admin', 'Belum Ada Admin')
                    ->description('Silakan tambahkan admin desa')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->color('danger'),
            ];
        }

        $lastLogin = $admin->last_login;
        $daysSinceLastLogin = $lastLogin ? (int) now('Asia/Jakarta')->diffInDays(Carbon::parse($lastLogin)) : null;
        // Format last login display
        if ($lastLogin) {
            $lastLoginDisplay = $daysSinceLastLogin == 0
                ? 'Hari ini'
                : $daysSinceLastLogin . ' hari lalu';
        } else {
            $lastLoginDisplay = 'Belum pernah logout';
        }

        return [
            Stat::make('Admin Aktif', $admin->name)
                ->description('Admin yang mengelola website')
                ->descriptionIcon('heroicon-m-user-circle')
                ->color('success'),

            Stat::make('Email Admin', $admin->email)
                ->description('Email untuk login admin')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('info'),

            Stat::make('Akun Dibuat', $admin->created_at->format('d M Y'))
                ->description($admin->created_at->diffForHumans())
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('gray'),

            Stat::make('Terakhir Logout', $lastLoginDisplay)
                ->description($lastLogin ? $lastLogin->format('d M Y, H:i') : 'Tidak ada data logout')
                ->descriptionIcon('heroicon-m-clock')
                ->color($daysSinceLastLogin && $daysSinceLastLogin > 7 ? 'warning' : 'success'),
        ];
    }
}

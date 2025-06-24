<?php

namespace App\Filament\Resources\GuestSubmissionResource\Widgets;

use App\Models\GuestSubmission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SubmissionOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Submission', GuestSubmission::count())
                ->description('Total kiriman dari guest')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),

            Stat::make('Menunggu Review', GuestSubmission::where('status', 'pending')->count())
                ->description('Perlu direview')
                ->descriptionIcon('heroicon-m-eye')
                ->color('warning'),

            Stat::make('Disetujui', GuestSubmission::where('status', 'approved')->count())
                ->description('Sudah di galeri')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Ditolak', GuestSubmission::where('status', 'rejected')->count())
                ->description('Tidak memenuhi kriteria')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Document;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', News::count())
                ->description('Berita yang dipublikasi')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total Dokumen', Document::count())
                ->description('Dokumen tersedia')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info')
                ->chart([17, 16, 14, 15, 14, 13, 12]),

            Stat::make('Total Gallery', Gallery::count())
                ->description('Foto & Video')
                ->descriptionIcon('heroicon-m-photo')
                ->color('warning')
                ->chart([15, 4, 10, 2, 12, 4, 12]),

            Stat::make('Total Produk', Product::count())
                ->description('Produk UMKM')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Total Pengguna', User::where('role', '!=', 'super_admin')->count())
                ->description('Pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('gray')
                ->chart([1, 1, 2, 2, 3, 3, 4]),

            Stat::make('Berita Unggulan', News::where('is_featured', true)->count())
                ->description('Berita unggulan')
                ->descriptionIcon('heroicon-m-star')
                ->color('success'),
        ];
    }
}

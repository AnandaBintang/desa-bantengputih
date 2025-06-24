<?php

namespace App\Filament\Widgets;

use App\Models\News;
use App\Models\Document;
use App\Models\Gallery;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class MonthlyContentChart extends ChartWidget
{
    protected static ?string $heading = 'Konten Bulanan (6 Bulan Terakhir)';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(function ($monthsBack) {
            return Carbon::now()->subMonths($monthsBack);
        });

        $newsData = $months->map(function ($month) {
            return News::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        });

        $documentsData = $months->map(function ($month) {
            return Document::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        });

        $galleryData = $months->map(function ($month) {
            return Gallery::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        });

        $productData = $months->map(function ($month) {
            return Product::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Berita',
                    'data' => $newsData->toArray(),
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                ],
                [
                    'label' => 'Dokumen',
                    'data' => $documentsData->toArray(),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
                [
                    'label' => 'Gallery',
                    'data' => $galleryData->toArray(),
                    'borderColor' => 'rgb(251, 191, 36)',
                    'backgroundColor' => 'rgba(251, 191, 36, 0.1)',
                ],
                [
                    'label' => 'Produk',
                    'data' => $productData->toArray(),
                    'borderColor' => 'rgb(168, 85, 247)',
                    'backgroundColor' => 'rgba(168, 85, 247, 0.1)',
                ],
            ],
            'labels' => $months->map(fn($month) => $month->format('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

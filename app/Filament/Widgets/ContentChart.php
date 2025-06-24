<?php

namespace App\Filament\Widgets;

use App\Models\Document;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ContentChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Konten';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Konten',
                    'data' => [
                        News::count(),
                        Document::count(),
                        Gallery::count(),
                        Product::count(),
                    ],
                    'backgroundColor' => [
                        'rgb(34, 197, 94)',
                        'rgb(59, 130, 246)',
                        'rgb(251, 191, 36)',
                        'rgb(168, 85, 247)',
                    ],
                ],
            ],
            'labels' => ['Berita', 'Dokumen', 'Gallery', 'Produk'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}

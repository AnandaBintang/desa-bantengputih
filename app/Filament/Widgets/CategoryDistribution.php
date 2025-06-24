<?php

namespace App\Filament\Widgets;

use App\Models\News;
use Filament\Widgets\ChartWidget;

class CategoryDistribution extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Kategori Berita';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $newsCategories = News::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Berita per Kategori',
                    'data' => array_values($newsCategories),
                    'backgroundColor' => [
                        'rgb(34, 197, 94)',
                        'rgb(59, 130, 246)',
                        'rgb(251, 191, 36)',
                        'rgb(239, 68, 68)',
                        'rgb(168, 85, 247)',
                    ],
                ],
            ],
            'labels' => array_keys($newsCategories),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Document;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class RecentActivities extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getRecentActivitiesQuery())
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'News' => 'success',
                        'Document' => 'info',
                        'Gallery' => 'warning',
                        'Product' => 'primary',
                    }),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([5, 10, 25])
            ->heading('Aktivitas Terbaru');
    }

    private function getRecentActivitiesQuery(): Builder
    {
        $news = News::query()->select(['id', 'title', 'created_at'])->addSelect(DB::raw("'News' as type"));
        $documents = Document::query()->select(['id', 'title', 'created_at'])->addSelect(DB::raw("'Document' as type"));
        $galleries = Gallery::query()->select(['id', 'title', 'created_at'])->addSelect(DB::raw("'Gallery' as type"));
        $products = Product::query()->select(['id', 'name as title', 'created_at'])->addSelect(DB::raw("'Product' as type"));

        return $news->union($documents)->union($galleries)->union($products);
    }
}

<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\DocumentResource;
use App\Filament\Resources\NewsResource;
use App\Filament\Resources\PhotoGalleryResource;
use App\Filament\Resources\ProductResource;
use Filament\Widgets\Widget;

class QuickActions extends Widget
{
    protected static string $view = 'filament.widgets.quick-actions';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        return [
            'actions' => [
                [
                    'label' => 'Tambah Berita',
                    'url' => NewsResource::getUrl('create'),
                    'icon' => 'heroicon-o-newspaper',
                    'color' => 'success',
                ],
                [
                    'label' => 'Upload Dokumen',
                    'url' => DocumentResource::getUrl('create'),
                    'icon' => 'heroicon-o-document-plus',
                    'color' => 'info',
                ],
                [
                    'label' => 'Tambah Foto',
                    'url' => PhotoGalleryResource::getUrl('create'),
                    'icon' => 'heroicon-o-photo',
                    'color' => 'zinc',
                ],
                [
                    'label' => 'Tambah Produk',
                    'url' => ProductResource::getUrl('create'),
                    'icon' => 'heroicon-o-shopping-bag',
                    'color' => 'primary',
                ],
            ]
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationLabel = 'Produk Desa';
    protected static ?string $pluralModelLabel = 'Produk Desa';
    protected static ?string $modelLabel = 'Produk Desa';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)->schema([
                TextInput::make('name')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255),

                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Pertanian' => 'Pertanian',
                        'Perikanan' => 'Perikanan',
                        'UMKM' => 'UMKM',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required(),

                TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->required(),

                TextInput::make('stock')
                    ->label('Stok')
                    ->numeric()
                    ->required(),

                Select::make('unit')
                    ->label('Satuan')
                    ->options([
                        'kg' => 'Kilogram (kg)',
                        'gram' => 'Gram (g)',
                        'liter' => 'Liter (L)',
                        'pcs' => 'Pieces (pcs)',
                        'pack' => 'Pack',
                        'box' => 'Box',
                    ])
                    ->default('kg')
                    ->required(),

                Toggle::make('is_featured')
                    ->label('Tampilkan di Beranda')
                    ->default(false),
            ]),

            RichEditor::make('description')
                ->label('Deskripsi')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                    'bulletList',
                    'orderedList',
                    'link',
                    'undo',
                    'redo',
                ])
                ->columnSpanFull(),

            SpatieMediaLibraryFileUpload::make('image')
                ->label('Gambar Produk')
                ->collection('products')
                ->image()
                ->imageEditor()
                ->imagePreviewHeight('250')
                ->loadingIndicatorPosition('left')
                ->panelAspectRatio('2:1')
                ->panelLayout('integrated')
                ->removeUploadedFileButtonPosition('right')
                ->uploadButtonPosition('left')
                ->uploadProgressIndicatorPosition('left')
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')
                ->label('Gambar')
                ->getStateUsing(fn($record) => $record->getFirstMediaUrl('products'))
                ->circular(),
            TextColumn::make('name')->label('Nama')->searchable()->sortable(),
            TextColumn::make('price')->label('Harga')->money('IDR')->sortable(),
            TextColumn::make('unit')->label('Satuan')->sortable(),
            TextColumn::make('category')->label('Kategori')->sortable(),
            IconColumn::make('is_featured')->label('Ditampilkan')->boolean(),
        ])->filters([
            SelectFilter::make('category')
                ->label('Kategori')
                ->options([
                    'Pertanian' => 'Pertanian',
                    'Perikanan' => 'Perikanan',
                ]),
            TrashedFilter::make(),
        ])->actions([
            EditAction::make(),
            DeleteAction::make()
                ->using(function ($record) {
                    $record->delete();
                }),
            RestoreAction::make(),
            ForceDeleteAction::make(),
        ])->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
                RestoreBulkAction::make(),
                ForceDeleteBulkAction::make(),
            ]),
        ])->modifyQueryUsing(fn(Builder $query) => $query->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]));
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

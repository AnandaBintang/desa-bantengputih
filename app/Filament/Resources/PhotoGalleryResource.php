<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoGalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotoGalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;
    protected static ?string $pluralModelLabel = 'Foto';
    protected static ?string $navigationGroup = 'Galeri';
    protected static ?string $navigationLabel = 'Foto';
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'photo');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Judul')
                ->required()
                ->maxLength(255),

            Select::make('category')
                ->label('Kategori')
                ->options([
                    'Kegiatan' => 'Kegiatan',
                    'Infrastruktur' => 'Infrastruktur',
                    'Alam' => 'Alam',
                    'Budaya' => 'Budaya',
                ])
                ->required(),

            RichEditor::make('description')
                ->label('Deskripsi')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                ])
                ->columnSpanFull(),

            SpatieMediaLibraryFileUpload::make('image')
                ->label('Gambar')
                ->collection('galleries')
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

            Hidden::make('type')->default('photo'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')
                ->label('Gambar')
                ->getStateUsing(fn(Gallery $record) => $record->getFirstMediaUrl('galleries'))
                ->circular()
                ->size(50)
                ->default('https://placehold.co/150')
                ->defaultImageUrl('https://placehold.co/150x150/cccccc/666666?text=No+Image'),

            TextColumn::make('title')->label('Judul')->searchable(),
            TextColumn::make('category')->label('Kategori')->sortable(),
            TextColumn::make('created_at')->label('Tanggal')->dateTime(),
        ])->filters([
            SelectFilter::make('category')
                ->label('Kategori')
                ->options([
                    'Kegiatan' => 'Kegiatan',
                    'Infrastruktur' => 'Infrastruktur',
                    'Alam' => 'Alam',
                    'Budaya' => 'Budaya',
                ]),
            TrashedFilter::make(),
        ])->actions([
            EditAction::make(),
            DeleteAction::make(),
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
            'index' => Pages\ListPhotoGalleries::route('/'),
            'create' => Pages\CreatePhotoGallery::route('/create'),
            'edit' => Pages\EditPhotoGallery::route('/{record}/edit'),
        ];
    }
}

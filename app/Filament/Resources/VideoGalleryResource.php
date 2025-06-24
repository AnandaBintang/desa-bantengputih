<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoGalleryResource\Pages;
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

class VideoGalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;
    protected static ?string $pluralModelLabel = 'Video';
    protected static ?string $navigationGroup = 'Galeri';
    protected static ?string $navigationLabel = 'Video';
    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'video');
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

            FileUpload::make('video')
                ->label('Video')
                ->disk('public')
                ->directory('gallery/videos')
                ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/mov', 'video/avi', 'video/wmv'])
                ->maxSize(204800)
                ->columnSpanFull()
                ->required(),

            Hidden::make('type')->default('video'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('video')
                ->label('Video')
                ->formatStateUsing(fn(?string $state): string => $state ? basename($state) : 'No Video')
                ->url(fn(Gallery $record): ?string => $record->video ? asset('storage/' . $record->video) : null)
                ->openUrlInNewTab()
                ->icon('heroicon-o-video-camera')
                ->iconColor('primary'),

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
            'index' => Pages\ListVideoGalleries::route('/'),
            'create' => Pages\CreateVideoGallery::route('/create'),
            'edit' => Pages\EditVideoGallery::route('/{record}/edit'),
        ];
    }
}

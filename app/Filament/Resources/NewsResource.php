<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Berita Desa';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Judul')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(function (string $context, $state, callable $set) {
                    $set('slug', Str::slug($state));
                    $set('meta_title', $state);
                }),

            Hidden::make('slug')
                ->label('Slug')
                ->required(),

            Select::make('category')
                ->label('Kategori')
                ->options([
                    'Pembangunan' => 'Pembangunan',
                    'Sosial' => 'Sosial',
                    'Budaya' => 'Budaya',
                    'Ekonomi' => 'Ekonomi',
                ])
                ->required()
                ->live()
                ->afterStateUpdated(function (string $context, $state, callable $set) {
                    $set('tags', $state);
                }),

            Toggle::make('is_featured')
                ->label('Tampilkan sebagai Berita Utama')
                ->helperText('Hanya satu berita yang bisa ditampilkan sebagai berita utama.')
                ->afterStateUpdated(function ($state, callable $set, $get, $record) {
                    if ($state) {
                        News::where('id', '!=', optional($record)->id)->update(['is_featured' => false]);
                    }
                }),

            TextInput::make('excerpt')
                ->label('Ringkasan')
                ->maxLength(100)
                ->columnSpanFull()
                ->live(onBlur: true)
                ->afterStateUpdated(function (string $context, $state, callable $set) {
                    $set('meta_description', $state);
                }),

            RichEditor::make('content')->label('Konten')->required()->columnSpanFull(),

            SpatieMediaLibraryFileUpload::make('image')
                ->label('Gambar')
                ->collection('news')
                ->image()
                ->required(),

            DateTimePicker::make('published_at')->label('Tanggal Publikasi')->required(),

            Hidden::make('meta_title')
                ->label('Meta Title'),

            Hidden::make('meta_description')
                ->label('Meta Deskripsi'),

            Hidden::make('tags')
                ->label('Tags'),

            Hidden::make('user_id')
                ->label('Penulis')
                ->default(auth()->id())
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')
                ->label('Gambar')
                ->getStateUsing(fn($record) => $record->getFirstMediaUrl('news')),
            TextColumn::make('title')->label('Judul')->searchable(),
            TextColumn::make('category')->label('Kategori')->sortable(),
            IconColumn::make('is_featured')
                ->label('Utama')
                ->boolean()
                ->trueIcon('heroicon-o-star')
                ->falseIcon('heroicon-o-star'),
            TextColumn::make('views_count')->label('Dilihat')->numeric()->sortable(),
            TextColumn::make('user.name')->label('Penulis')->sortable(),
            TextColumn::make('published_at')->label('Dipublikasikan')->dateTime(),
        ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('user_id')
                    ->label('Penulis')
                    ->options(User::pluck('name', 'id')),
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Pembangunan' => 'Pembangunan',
                        'Sosial' => 'Sosial',
                        'Budaya' => 'Budaya',
                        'Ekonomi' => 'Ekonomi',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

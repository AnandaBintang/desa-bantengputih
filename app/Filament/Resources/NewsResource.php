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
use Filament\Notifications\Notification;

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
                ->afterStateUpdated(function (string $context, $state, callable $set, callable $get, $livewire) {
                    if (empty($state)) return;

                    // Generate slug from title
                    $slug = Str::slug($state);
                    $originalSlug = $slug;
                    $counter = 1;

                    // Get current record ID if editing
                    $currentId = $livewire->record->id ?? null;

                    // Check if slug exists (excluding current record if editing)
                    while (News::where('slug', $slug)
                        ->when($currentId, fn($query) => $query->where('id', '!=', $currentId))
                        ->exists()
                    ) {
                        $slug = $originalSlug . '-' . $counter;
                        $counter++;
                    }

                    // Check if title already exists (excluding current record if editing)
                    $titleExists = News::where('title', $state)
                        ->when($currentId, fn($query) => $query->where('id', '!=', $currentId))
                        ->exists();

                    if ($titleExists) {
                        Notification::make()
                            ->title('Judul Sudah Ada')
                            ->body('Judul telah ada, silahkan buat judul lain!')
                            ->danger()
                            ->duration(5000)
                            ->send();

                        // Clear the title field
                        $set('title', '');
                        $set('slug', '');
                        $set('meta_title', '');
                        return;
                    }

                    // Set the generated slug and meta title
                    $set('slug', $slug);
                    $set('meta_title', $state);
                })
                ->rules([
                    function ($get, $livewire) {
                        return function (string $attribute, $value, \Closure $fail) use ($get, $livewire) {
                            if (empty($value)) return;

                            $currentId = $livewire->record->id ?? null;

                            $exists = News::where('title', $value)
                                ->when($currentId, fn($query) => $query->where('id', '!=', $currentId))
                                ->exists();

                            if ($exists) {
                                $fail('Judul telah ada, silahkan buat judul lain!');
                            }
                        };
                    }
                ]),

            // Hidden slug field (readonly)
            Hidden::make('slug')
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
                    $set('tags', [$state, 'berita-desa', 'bantengputih']);
                }),

            Toggle::make('is_featured')
                ->label('Tampilkan sebagai Berita Utama')
                ->helperText('Hanya satu berita yang bisa ditampilkan sebagai berita utama.')
                ->afterStateUpdated(function ($state, callable $set, $get, $record) {
                    if ($state) {
                        News::where('id', '!=', optional($record)->id)->update(['is_featured' => false]);

                        Notification::make()
                            ->title('Berita Utama Diperbarui')
                            ->body('Berita ini sekarang menjadi berita utama. Berita utama sebelumnya telah dinonaktifkan.')
                            ->success()
                            ->send();
                    }
                }),

            TextInput::make('excerpt')
                ->label('Ringkasan')
                ->maxLength(200)
                ->columnSpanFull()
                ->live(onBlur: true)
                ->afterStateUpdated(function (string $context, $state, callable $set) {
                    $set('meta_description', $state);
                })
                ->helperText('Ringkasan singkat untuk preview berita (maksimal 200 karakter).'),

            RichEditor::make('content')
                ->label('Konten')
                ->required()
                ->columnSpanFull()
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'blockquote',
                    'h2',
                    'h3',
                    'link',
                    'undo',
                    'redo',
                ]),

            SpatieMediaLibraryFileUpload::make('image')
                ->label('Gambar Utama')
                ->collection('news')
                ->image()
                ->imageEditor()
                ->required()
                ->helperText('Gambar utama yang akan ditampilkan di halaman berita.'),

            DateTimePicker::make('published_at')
                ->label('Tanggal Publikasi')
                ->required()
                ->default(now())
                ->helperText('Berita akan dipublikasikan pada tanggal dan waktu yang ditentukan.'),

            Hidden::make('meta_title'),
            Hidden::make('meta_description'),
            Hidden::make('tags'),
            Hidden::make('user_id')
                ->default(auth()->id())
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')
                ->label('Gambar')
                ->getStateUsing(fn($record) => $record->getFirstMediaUrl('news'))
                ->defaultImageUrl('https://placehold.co/150x100/4CAF50/FFFFFF?text=No+Image')
                ->size(60),

            TextColumn::make('title')
                ->label('Judul')
                ->searchable()
                ->limit(50)
                ->tooltip(function (TextColumn $column): ?string {
                    $state = $column->getState();
                    return strlen($state) > 50 ? $state : null;
                }),

            TextColumn::make('category')
                ->label('Kategori')
                ->sortable()
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    'Pembangunan' => 'info',
                    'Sosial' => 'warning',
                    'Ekonomi' => 'success',
                    'Budaya' => 'danger',
                    default => 'gray',
                }),

            IconColumn::make('is_featured')
                ->label('Utama')
                ->boolean()
                ->trueIcon('heroicon-o-star')
                ->falseIcon('heroicon-o-star')
                ->trueColor('warning')
                ->falseColor('gray'),

            TextColumn::make('views_count')
                ->label('Dilihat')
                ->numeric()
                ->sortable()
                ->default(0),

            TextColumn::make('user.name')
                ->label('Penulis')
                ->sortable(),

            TextColumn::make('published_at')
                ->label('Dipublikasikan')
                ->dateTime('d M Y, H:i')
                ->sortable(),

            TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime('d M Y, H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('user_id')
                    ->label('Penulis')
                    ->options(User::pluck('name', 'id')),
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'pembangunan' => 'Pembangunan',
                        'sosial' => 'Sosial',
                        'budaya' => 'Budaya',
                        'ekonomi' => 'Ekonomi',
                    ]),
                SelectFilter::make('is_featured')
                    ->label('Status')
                    ->options([
                        1 => 'Berita Utama',
                        0 => 'Berita Biasa',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Berita')
                    ->modalDescription('Apakah Anda yakin ingin menghapus berita ini? Data akan dipindahkan ke trash.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
                RestoreAction::make(),
                ForceDeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Permanen')
                    ->modalDescription('Apakah Anda yakin ingin menghapus berita ini secara permanen? Data tidak dapat dikembalikan.')
                    ->modalSubmitActionLabel('Ya, Hapus Permanen'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc')
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

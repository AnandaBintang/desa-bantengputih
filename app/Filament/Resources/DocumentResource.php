<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;
    protected static ?string $navigationLabel = 'Dokumen Desa';
    protected static ?string $pluralModelLabel = 'Dokumen Desa';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Konten Website';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Judul Dokumen')
                ->required()
                ->maxLength(255),

            Select::make('category')
                ->label('Kategori')
                ->options([
                    'Produk Hukum' => 'Produk Hukum',
                    'Layanan Informasi' => 'Layanan Informasi',
                ])
                ->required(),

            Select::make('type')
                ->label('Tipe Dokumen')
                ->options([
                    'Peraturan Desa' => 'Peraturan Desa',
                    'Keputusan Kepala Desa' => 'Keputusan Kepala Desa',
                    'Program & Kegiatan' => 'Program & Kegiatan',
                    'Laporan' => 'Laporan',
                ])
                ->required(),

            RichEditor::make('description')
                ->label('Deskripsi')
                ->columnSpanFull(),

            FileUpload::make('file')
                ->label('Unggah Dokumen')
                ->preserveFilenames()
                ->directory('documents')
                ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                ->maxSize(10240)
                ->downloadable()
                ->previewable()
                ->openable()
                ->required(),

            DatePicker::make('uploaded_at')
                ->label('Tanggal Unggah')
                ->default(now())
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            IconColumn::make('file_type')
                ->label('Tipe')
                ->getStateUsing(function (Document $record): string {
                    $extension = pathinfo($record->file, PATHINFO_EXTENSION);
                    return match (strtolower($extension)) {
                        'pdf' => 'pdf',
                        'doc', 'docx' => 'word',
                        'xls', 'xlsx' => 'excel',
                        default => 'document'
                    };
                })
                ->icon(fn(string $state): string => match ($state) {
                    'pdf' => 'heroicon-o-document-text',
                    'word' => 'heroicon-o-document',
                    'excel' => 'heroicon-o-table-cells',
                    default => 'heroicon-o-document'
                })
                ->color(fn(string $state): string => match ($state) {
                    'pdf' => 'danger',
                    'word' => 'info',
                    'excel' => 'success',
                    default => 'gray'
                }),

            TextColumn::make('title')->label('Judul')->searchable()->limit(30),
            TextColumn::make('category')->label('Kategori')->sortable(),
            TextColumn::make('type')->label('Tipe')->sortable(),
            TextColumn::make('uploaded_at')->label('Tanggal')->date(),

            TextColumn::make('file_size')
                ->label('Ukuran')
                ->getStateUsing(function (Document $record): string {
                    if ($record->file && Storage::disk('public')->exists($record->file)) {
                        $bytes = Storage::disk('public')->size($record->file);
                        return self::formatBytes($bytes);
                    }
                    return 'N/A';
                }),
        ])->filters([
            SelectFilter::make('category')->label('Kategori')->options([
                'Produk Hukum' => 'Produk Hukum',
                'Layanan Informasi' => 'Layanan Informasi',
            ]),
            SelectFilter::make('type')->label('Tipe')->options([
                'Peraturan Desa' => 'Peraturan Desa',
                'Keputusan Kepala Desa' => 'Keputusan Kepala Desa',
                'Program & Kegiatan' => 'Program & Kegiatan',
                'Laporan' => 'Laporan',
            ]),
            TrashedFilter::make(),
        ])->actions([
            Action::make('preview')
                ->label('Preview')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->url(fn(Document $record): string => route('document.preview', $record))
                ->openUrlInNewTab()
                ->visible(
                    fn(Document $record): bool =>
                    $record->file && pathinfo($record->file, PATHINFO_EXTENSION) === 'pdf'
                ),

            Action::make('download')
                ->label('Download')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->url(fn(Document $record): string => route('document.download', $record))
                ->openUrlInNewTab(),

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

    private static function formatBytes($bytes, $precision = 2): string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}

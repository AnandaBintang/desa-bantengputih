<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VillageResource\Pages;
use App\Filament\Resources\VillageResource\Pages\ManageVillages;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VillageResource extends Resource
{
    protected static ?string $model = Village::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Informasi Desa';

    protected static ?string $navigationGroup = 'Pengaturan Website';

    protected static ?string $modelLabel = 'Informasi Desa';

    protected static ?string $pluralModelLabel = 'Informasi Desa';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Umum')
                    ->description('Informasi dasar tentang desa')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Desa')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Desa Bantengputih'),

                        Textarea::make('description')
                            ->label('Deskripsi Desa')
                            ->rows(4)
                            ->placeholder('Deskripsi singkat tentang desa...')
                            ->columnSpanFull(),

                        FileUpload::make('logo')
                            ->label('Logo Desa')
                            ->image()
                            ->disk('public')
                            ->directory('village')
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('200')
                            ->imageResizeTargetHeight('200')
                            ->helperText('Upload logo desa (format: JPG, PNG, SVG. Maksimal 2MB)')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/svg+xml'])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Alamat & Lokasi')
                    ->description('Informasi alamat dan lokasi desa')
                    ->schema([
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->rows(3)
                            ->placeholder('Contoh: Desa Bantengputih, Kecamatan Karanggeneng, Kabupaten Lamongan, Provinsi Jawa Timur')
                            ->columnSpanFull(),
                    ]),

                Section::make('Kontak & Website')
                    ->description('Informasi kontak dan website desa')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->placeholder('Contoh: 081234567890')
                            ->helperText('Nomor telepon akan digunakan untuk WhatsApp juga'),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->placeholder('Contoh: info@bantengputih.com'),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->placeholder('Contoh: https://bantengputih.lamongan.go.id')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->height(50)
                    ->width(50)
                    ->circular(),

                TextColumn::make('name')
                    ->label('Nama Desa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([])
            ->emptyStateHeading('Belum Ada Data Desa')
            ->emptyStateDescription('Silakan tambahkan informasi desa terlebih dahulu.')
            ->emptyStateIcon('heroicon-o-building-office-2');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageVillages::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        // Only allow creating if no village exists
        return Village::count() === 0;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::count();
        return $count > 0 ? null : 'Belum diisi';
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::count();
        return $count > 0 ? 'success' : 'warning';
    }
}

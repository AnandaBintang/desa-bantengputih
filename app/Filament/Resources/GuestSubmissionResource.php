<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestSubmissionResource\Pages;
use App\Models\GuestSubmission;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class GuestSubmissionResource extends Resource
{
    protected static ?string $model = GuestSubmission::class;
    protected static ?string $navigationLabel = 'Review Kiriman';
    protected static ?string $navigationGroup = 'Galeri';
    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('status', 'pending')->count() > 0 ? 'warning' : 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengirim')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telepon')
                            ->disabled(),
                    ])->columns(3),

                Forms\Components\Section::make('Konten')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->disabled(),
                        Forms\Components\Select::make('type')
                            ->label('Jenis')
                            ->options([
                                'photo' => 'Foto',
                                'video' => 'Video',
                            ])
                            ->disabled(),
                        Forms\Components\Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Kegiatan' => 'Kegiatan',
                                'Infrastruktur' => 'Infrastruktur',
                                'Alam' => 'Alam',
                                'Budaya' => 'Budaya',
                            ])
                            ->disabled(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(3),

                Forms\Components\Section::make('File')
                    ->schema([
                        Forms\Components\ViewField::make('file_preview')
                            ->label('Preview')
                            ->view('filament.forms.components.file-preview'),
                        Forms\Components\TextInput::make('file_name')
                            ->label('Nama File')
                            ->disabled(),
                        Forms\Components\TextInput::make('file_size_human')
                            ->label('Ukuran File')
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Review')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Menunggu Review',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Catatan Admin')
                            ->placeholder('Berikan catatan untuk submission ini...')
                            ->columnSpanFull(),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public')
                    ->visibility('public')
                    ->size(60)
                    ->circular()
                    ->defaultImageUrl(
                        fn(GuestSubmission $record) =>
                        $record->type === 'video'
                            ? 'https://placehold.co/60x60/4CAF50/FFFFFF?text=VIDEO'
                            : 'https://placehold.co/60x60/2196F3/FFFFFF?text=IMG'
                    ),

                TextColumn::make('name')
                    ->label('Pengirim')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(30),

                BadgeColumn::make('type')
                    ->label('Jenis')
                    ->colors([
                        'primary' => 'photo',
                        'success' => 'video',
                    ])
                    ->icons([
                        'heroicon-o-photo' => 'photo',
                        'heroicon-o-video-camera' => 'video',
                    ]),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),

                TextColumn::make('created_at')
                    ->label('Dikirim')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('reviewed_at')
                    ->label('Direview')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->placeholder('Belum direview'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu Review',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ]),
                SelectFilter::make('type')
                    ->label('Jenis')
                    ->options([
                        'photo' => 'Foto',
                        'video' => 'Video',
                    ]),
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Kegiatan' => 'Kegiatan',
                        'Infrastruktur' => 'Infrastruktur',
                        'Alam' => 'Alam',
                        'Budaya' => 'Budaya',
                    ]),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn(GuestSubmission $record) => $record->status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Catatan (Opsional)')
                            ->placeholder('Catatan persetujuan...')
                    ])
                    ->action(function (GuestSubmission $record, array $data) {
                        $record->approve(Auth::id(), $data['admin_notes'] ?? null);

                        Notification::make()
                            ->title('Submission Disetujui')
                            ->body('Konten telah ditambahkan ke galeri.')
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn(GuestSubmission $record) => $record->status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->placeholder('Jelaskan mengapa submission ini ditolak...')
                    ])
                    ->action(function (GuestSubmission $record, array $data) {
                        $record->reject(Auth::id(), $data['admin_notes']);

                        Notification::make()
                            ->title('Submission Ditolak')
                            ->body('Pengirim akan mendapat notifikasi penolakan.')
                            ->warning()
                            ->send();
                    }),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuestSubmissions::route('/'),
            'create' => Pages\CreateGuestSubmission::route('/create'),
            'view' => Pages\ViewGuestSubmission::route('/{record}'),
            'edit' => Pages\EditGuestSubmission::route('/{record}/edit'),
        ];
    }
}

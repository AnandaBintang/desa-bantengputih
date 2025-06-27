<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\ManageAdmin;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Pengaturan Website';

    protected static ?string $navigationLabel = 'Admin Desa';

    protected static ?string $modelLabel = 'Admin Desa';

    protected static ?string $pluralModelLabel = 'Admin Desa';

    protected static ?int $navigationSort = 3;

    // Exclude super_admin from all queries
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where(function ($query) {
                $query->where('role', '!=', 'super_admin')
                    ->orWhereNull('role');
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Admin Desa')
                    ->description('Kelola informasi admin yang mengelola website desa')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Bapak/Ibu Admin Desa'),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(User::class, 'email', ignoreRecord: true)
                            ->placeholder('admin@bantengputih.com'),

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->minLength(8)
                            ->placeholder('Minimal 8 karakter')
                            ->helperText(
                                fn(string $context): string =>
                                $context === 'edit'
                                    ? 'Kosongkan jika tidak ingin mengubah password'
                                    : 'Password minimal 8 karakter'
                            ),

                        TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->same('password')
                            ->dehydrated(false)
                            ->required(fn(string $context): bool => $context === 'create')
                            ->placeholder('Ulangi password di atas'),

                        // Hidden field to set role as admin_desa when creating
                        Forms\Components\Hidden::make('role')
                            ->default('admin_desa'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin_desa' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'admin_desa' => 'Admin Desa',
                        default => ucfirst($state),
                    })
                    ->visible(fn() => User::whereNotNull('role')->where('role', '!=', 'super_admin')->exists()),

                TextColumn::make('created_at')
                    ->label('Akun Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
            ])
            ->bulkActions([
                // No bulk actions for single admin
            ])
            ->emptyStateHeading('Belum Ada Admin Desa')
            ->emptyStateDescription('Silakan tambahkan admin desa untuk mengelola website.')
            ->emptyStateIcon('heroicon-o-user-circle');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAdmin::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        // Only allow creating if no admin_desa exists
        return User::where('role', 'admin_desa')
            ->orWhereNull('role')
            ->where('role', '!=', 'super_admin')
            ->count() === 0;
    }

    public static function canDelete($record): bool
    {
        // Don't allow deleting super_admin
        if ($record->role === 'super_admin') {
            return false;
        }

        // Don't allow deleting if this is the only non-super admin
        return User::where('role', '!=', 'super_admin')
            ->orWhereNull('role')
            ->count() > 1;
    }

    public static function canEdit($record): bool
    {
        // Don't allow editing super_admin
        return $record->role !== 'super_admin';
    }

    public static function canView($record): bool
    {
        // Don't allow viewing super_admin
        return $record->role !== 'super_admin';
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('role', '!=', 'super_admin')
            ->orWhereNull('role')
            ->count();
        return $count > 0 ? null : 'Belum ada';
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('role', '!=', 'super_admin')
            ->orWhereNull('role')
            ->count();
        return $count > 0 ? 'success' : 'danger';
    }
}

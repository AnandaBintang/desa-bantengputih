<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Widgets\AdminOverview;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageAdmin extends ManageRecords
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Admin Desa';

    public function mount(): void
    {
        // If no admin exists, redirect to create
        if (User::count() === 0) {
            $this->mountAction('create');
        } else {
            // If admin exists, load it for editing
            $admin = User::first();
            $this->mountAction('edit', ['record' => $admin->id]);
        }
    }

    protected function getHeaderActions(): array
    {
        $admin = User::first();

        if (!$admin) {
            return [
                CreateAction::make()
                    ->label('Tambah Admin Desa')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Tambah Admin Desa')
                    ->modalDescription('Buat akun admin untuk mengelola website desa')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Admin desa berhasil ditambahkan')
                            ->body('Akun admin telah dibuat dan dapat digunakan untuk login.')
                    ),
            ];
        }

        return [
            EditAction::make()
                ->label('Edit Profil Admin')
                ->icon('heroicon-o-pencil-square')
                ->record($admin)
                ->modalHeading('Edit Profil Admin Desa')
                ->modalDescription('Perbarui informasi admin desa')
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Profil admin berhasil diperbarui')
                        ->body('Perubahan telah disimpan.')
                ),

            Action::make('change_password')
                ->label('Ganti Password')
                ->icon('heroicon-o-key')
                ->color('warning')
                ->form([
                    TextInput::make('current_password')
                        ->label('Password Saat Ini')
                        ->password()
                        ->required()
                        ->rule('current_password'),

                    TextInput::make('new_password')
                        ->label('Password Baru')
                        ->password()
                        ->required()
                        ->minLength(8)
                        ->different('current_password'),

                    TextInput::make('new_password_confirmation')
                        ->label('Konfirmasi Password Baru')
                        ->password()
                        ->required()
                        ->same('new_password'),
                ])
                ->action(function (array $data) use ($admin) {
                    $admin->update([
                        'password' => \Illuminate\Support\Facades\Hash::make($data['new_password'])
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Password berhasil diubah')
                        ->body('Password baru telah disimpan.')
                        ->send();
                })
                ->modalHeading('Ganti Password Admin')
                ->modalDescription('Ubah password untuk keamanan akun admin'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AdminOverview::class,
        ];
    }
}

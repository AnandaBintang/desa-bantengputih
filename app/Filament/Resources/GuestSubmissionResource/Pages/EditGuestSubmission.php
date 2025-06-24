<?php

namespace App\Filament\Resources\GuestSubmissionResource\Pages;

use App\Filament\Resources\GuestSubmissionResource;
use App\Models\GuestSubmission;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditGuestSubmission extends EditRecord
{
    protected static string $resource = GuestSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('approve')
                ->label('Setujui')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn(GuestSubmission $record) => $record->status === 'pending')
                ->form([
                    Forms\Components\Textarea::make('admin_notes')
                        ->label('Catatan Persetujuan (Opsional)')
                        ->placeholder('Tambahkan catatan untuk persetujuan ini...')
                        ->rows(3),
                ])
                ->action(function (GuestSubmission $record, array $data) {
                    $record->approve(Auth::id(), $data['admin_notes'] ?? null);

                    Notification::make()
                        ->title('Submission Disetujui')
                        ->body('Konten telah berhasil ditambahkan ke galeri.')
                        ->success()
                        ->send();

                    return redirect()->route('filament.admin.resources.guest-submissions.index');
                }),

            Actions\Action::make('reject')
                ->label('Tolak')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn(GuestSubmission $record) => $record->status === 'pending')
                ->form([
                    Forms\Components\Textarea::make('admin_notes')
                        ->label('Alasan Penolakan')
                        ->placeholder('Jelaskan mengapa submission ini ditolak...')
                        ->required()
                        ->rows(3),
                ])
                ->action(function (GuestSubmission $record, array $data) {
                    $record->reject(Auth::id(), $data['admin_notes']);

                    Notification::make()
                        ->title('Submission Ditolak')
                        ->body('Pengirim akan mendapat notifikasi penolakan.')
                        ->warning()
                        ->send();

                    return redirect()->route('filament.admin.resources.guest-submissions.index');
                }),

            Actions\ViewAction::make(),
            Actions\DeleteAction::make()
                ->before(function (GuestSubmission $record) {
                    // Delete the associated file when deleting the record
                    $record->deleteFile();
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Submission berhasil diperbarui';
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Set reviewed_at and reviewed_by when status changes
        if (isset($data['status']) && $data['status'] !== 'pending') {
            $data['reviewed_at'] = now();
            $data['reviewed_by'] = Auth::id();
        }

        return $data;
    }
}

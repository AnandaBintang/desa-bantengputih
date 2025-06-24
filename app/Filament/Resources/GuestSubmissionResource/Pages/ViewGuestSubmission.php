<?php

namespace App\Filament\Resources\GuestSubmissionResource\Pages;

use App\Filament\Resources\GuestSubmissionResource;
use App\Models\GuestSubmission;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ViewGuestSubmission extends ViewRecord
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

            Actions\Action::make('download')
                ->label('Download File')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->visible(fn(GuestSubmission $record) => Storage::disk('public')->exists($record->file_path))
                ->url(fn(GuestSubmission $record) => Storage::disk('public')->url($record->file_path))
                ->openUrlInNewTab(),

            Actions\EditAction::make()
                ->visible(fn(GuestSubmission $record) => $record->status === 'pending'),

            Actions\DeleteAction::make()
                ->before(function (GuestSubmission $record) {
                    // Delete the associated file when deleting the record
                    $record->deleteFile();
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            GuestSubmissionResource\Widgets\SubmissionOverview::class,
        ];
    }
}

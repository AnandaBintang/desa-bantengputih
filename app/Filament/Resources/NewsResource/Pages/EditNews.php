<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use App\Models\News;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Hapus Berita')
                ->modalDescription('Apakah Anda yakin ingin menghapus berita ini?')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Berita Dihapus')
                        ->body('Berita telah berhasil dihapus.')
                ),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berita Berhasil Diperbarui')
            ->body('Perubahan telah berhasil disimpan.')
            ->duration(5000);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Generate unique slug if not set or title changed
        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = $this->generateUniqueSlug($data['title'], $this->record->id);
        }

        return $data;
    }

    private function generateUniqueSlug(string $title, int $excludeId): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (News::where('slug', $slug)->where('id', '!=', $excludeId)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function beforeSave(): void
    {
        // Additional validation before saving
        $title = $this->data['title'] ?? '';

        if (!empty($title)) {
            $exists = News::where('title', $title)
                ->where('id', '!=', $this->record->id)
                ->exists();

            if ($exists) {
                Notification::make()
                    ->title('Judul Sudah Ada')
                    ->body('Judul telah ada, silahkan buat judul lain!')
                    ->danger()
                    ->persistent()
                    ->send();

                $this->halt();
            }
        }
    }
}

<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use App\Models\News;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berita Berhasil Dibuat')
            ->body('Berita telah berhasil dibuat dan dipublikasikan.')
            ->duration(5000);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure user_id is set
        $data['user_id'] = auth()->id();

        // Ensure views_count starts at 0
        $data['views_count'] = 0;

        // Generate unique slug if not set
        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = $this->generateUniqueSlug($data['title']);
        }

        return $data;
    }

    private function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function beforeCreate(): void
    {
        // Additional validation before creating
        $title = $this->data['title'] ?? '';

        if (!empty($title)) {
            $exists = News::where('title', $title)->exists();

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

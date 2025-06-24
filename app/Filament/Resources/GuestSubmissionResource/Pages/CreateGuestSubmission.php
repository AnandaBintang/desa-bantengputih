<?php

namespace App\Filament\Resources\GuestSubmissionResource\Pages;

use App\Filament\Resources\GuestSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGuestSubmission extends CreateRecord
{
    protected static string $resource = GuestSubmissionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Submission berhasil ditambahkan';
    }
}

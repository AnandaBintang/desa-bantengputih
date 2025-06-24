<?php

namespace App\Filament\Resources\GuestSubmissionResource\Pages;

use App\Filament\Resources\GuestSubmissionResource;
use App\Models\GuestSubmission;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListGuestSubmissions extends ListRecords
{
    protected static string $resource = GuestSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Submission')
                ->visible(false), // Hide create action since submissions come from guests
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(GuestSubmission::count()),

            'pending' => Tab::make('Menunggu Review')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'pending'))
                ->badge(GuestSubmission::where('status', 'pending')->count())
                ->badgeColor('warning'),

            'approved' => Tab::make('Disetujui')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'approved'))
                ->badge(GuestSubmission::where('status', 'approved')->count())
                ->badgeColor('success'),

            'rejected' => Tab::make('Ditolak')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'rejected'))
                ->badge(GuestSubmission::where('status', 'rejected')->count())
                ->badgeColor('danger'),

            'photos' => Tab::make('Foto')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'photo'))
                ->badge(GuestSubmission::where('type', 'photo')->count())
                ->badgeColor('primary'),

            'videos' => Tab::make('Video')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'video'))
                ->badge(GuestSubmission::where('type', 'video')->count())
                ->badgeColor('success'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            GuestSubmissionResource\Widgets\SubmissionOverview::class,
        ];
    }
}

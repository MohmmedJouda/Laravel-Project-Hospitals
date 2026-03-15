<?php

namespace App\Filament\Resources\MajorsResource\Pages;

use App\Filament\Resources\MajorsResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditMajors extends EditRecord
{
    protected static string $resource = MajorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getUpdatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Major updated')
            ->body('The major has been updated successfully.');
    }
}

<?php

namespace App\Filament\Resources\MajorsResource\Pages;

use App\Filament\Resources\MajorsResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMajors extends CreateRecord
{
    protected static string $resource = MajorsResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Major created')
            ->body('The major has been created successfully.');
    }
}

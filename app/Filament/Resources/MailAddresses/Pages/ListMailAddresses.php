<?php

namespace App\Filament\Resources\MailAddresses\Pages;

use App\Filament\Resources\MailAddresses\MailAddressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMailAddresses extends ListRecords
{
    protected static string $resource = MailAddressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

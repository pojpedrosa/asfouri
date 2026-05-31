<?php

namespace App\Filament\Resources\MailAddresses\Pages;

use App\Filament\Resources\MailAddresses\MailAddressResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMailAddress extends EditRecord
{
    protected static string $resource = MailAddressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

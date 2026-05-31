<?php

namespace App\Filament\Resources\MailAddresses\Pages;

use App\Filament\Resources\MailAddresses\MailAddressResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMailAddress extends CreateRecord
{
    protected static string $resource = MailAddressResource::class;
}

<?php

namespace App\Filament\Resources\InboundEmails\Pages;

use App\Filament\Resources\InboundEmails\InboundEmailResource;
use Filament\Resources\Pages\ListRecords;

class ListInboundEmails extends ListRecords
{
    protected static string $resource = InboundEmailResource::class;

    protected function getHeaderActions(): array
    {
        // Inbox is read-only — mail arrives via Postfix, never created by hand.
        return [];
    }
}

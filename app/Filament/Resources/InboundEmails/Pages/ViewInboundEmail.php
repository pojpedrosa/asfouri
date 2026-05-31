<?php

namespace App\Filament\Resources\InboundEmails\Pages;

use App\Filament\Resources\InboundEmails\InboundEmailResource;
use Filament\Resources\Pages\ViewRecord;

class ViewInboundEmail extends ViewRecord
{
    protected static string $resource = InboundEmailResource::class;

    protected function afterFill(): void
    {
        // Opening an email marks it read.
        if ($this->record && ! $this->record->is_read) {
            $this->record->update(['is_read' => true]);
        }
    }
}

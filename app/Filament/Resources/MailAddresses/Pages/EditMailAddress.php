<?php

namespace App\Filament\Resources\MailAddresses\Pages;

use App\Filament\Resources\MailAddresses\MailAddressResource;
use App\Filament\Resources\MailAddresses\Schemas\MailAddressForm;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditMailAddress extends EditRecord
{
    protected static string $resource = MailAddressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    /** Prefill the account's name from its login. */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->getRecord()->user) {
            $data['account_name'] = $this->getRecord()->user->name;
        }

        return $data;
    }

    /** Persist profile + password changes to the linked login when this is an account. */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (MailAddressForm::isAccount($record)) {
            $user = $record->user;
            // Keep the login email in sync with the address.
            $user->email = strtolower(($data['local_part'] ?? $record->local_part).'@'.($data['domain'] ?? $record->domain));
            if (filled($data['account_name'] ?? null)) {
                $user->name = $data['account_name'];
            }
            if (filled($data['account_password'] ?? null)) {
                $user->password = $data['account_password'];
            }
            $user->save();
        }

        unset($data['account_name'], $data['account_password'], $data['has_login']);

        $record->update($data);

        return $record;
    }
}

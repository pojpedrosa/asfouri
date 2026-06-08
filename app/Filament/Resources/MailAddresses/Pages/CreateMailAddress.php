<?php

namespace App\Filament\Resources\MailAddresses\Pages;

use App\Filament\Resources\MailAddresses\MailAddressResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateMailAddress extends CreateRecord
{
    protected static string $resource = MailAddressResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $hasLogin = (bool) ($data['has_login'] ?? true);

        if ($hasLogin) {
            // Creating an email account also creates a back-office login whose
            // own inbox receives this address.
            $email = strtolower(trim($data['local_part'].'@'.$data['domain']));

            $user = User::firstOrNew(['email' => $email]);
            $user->name = $data['account_name'] ?: $data['local_part'];
            $user->password = $data['account_password'] ?: Str::random(20);
            $user->is_admin = false;
            $user->save();

            $data['user_id'] = $user->id;
        }
        // Alias: $data['user_id'] already holds the chosen destination inbox.

        unset($data['has_login'], $data['account_name'], $data['account_password']);

        return static::getModel()::create($data);
    }
}

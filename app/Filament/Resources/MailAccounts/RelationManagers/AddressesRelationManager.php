<?php

namespace App\Filament\Resources\MailAccounts\RelationManagers;

use App\Filament\Resources\MailAddresses\Schemas\MailAddressForm;
use App\Models\MailAddress;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddressesRelationManager extends RelationManager
{
    protected static string $relationship = 'addresses';

    protected static ?string $title = 'Endereços';

    public function form(Schema $schema): Schema
    {
        return MailAddressForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('local_part')
            ->columns([
                TextColumn::make('address')
                    ->label('Endereço')
                    ->state(fn (MailAddress $r) => $r->local_part.'@'.$r->domain)
                    ->copyable(),
                TextColumn::make('forward_to')
                    ->label('Reencaminha para')
                    ->placeholder('—'),
                IconColumn::make('deliver_to_inbox')->label('Caixa')->boolean(),
                IconColumn::make('enabled')->label('Activo')->boolean(),
            ])
            ->headerActions([
                CreateAction::make()->label('Novo endereço'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

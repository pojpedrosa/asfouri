<?php

namespace App\Filament\Resources\MailAddresses\Tables;

use App\Models\MailAddress;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class MailAddressesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('address')
                    ->label('Endereço')
                    ->state(fn (MailAddress $r) => $r->local_part.'@'.$r->domain)
                    ->weight('medium')
                    ->copyable()
                    ->searchable(['local_part', 'domain'])
                    ->sortable(['local_part']),
                TextColumn::make('account.name')
                    ->label('Conta')
                    ->placeholder('—')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('forward_to')
                    ->label('Reencaminha para')
                    ->placeholder('—')
                    ->html()
                    ->formatStateUsing(fn (?string $state) => $state
                        ? collect(explode(',', $state))->map(fn ($e) => e(trim($e)))->filter()->implode('<br>')
                        : '—'),
                IconColumn::make('deliver_to_inbox')
                    ->label('Caixa de entrada')
                    ->boolean(),
                IconColumn::make('enabled')
                    ->label('Activo')
                    ->boolean(),
            ])
            ->filters([
                TernaryFilter::make('enabled')->label('Activo'),
                TernaryFilter::make('deliver_to_inbox')->label('Na caixa de entrada'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('local_part', 'asc');
    }
}

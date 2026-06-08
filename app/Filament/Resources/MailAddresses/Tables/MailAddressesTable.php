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
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->state(fn (MailAddress $r) => $r->user && strtolower($r->user->email) === strtolower($r->local_part.'@'.$r->domain) ? 'Conta' : 'Alias')
                    ->color(fn (string $state) => $state === 'Conta' ? 'primary' : 'gray'),
                TextColumn::make('user.name')
                    ->label('Caixa de')
                    ->description(fn (MailAddress $r) => $r->user?->email)
                    ->placeholder('—')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('forward_to')
                    ->label('Reencaminha também')
                    ->placeholder('—')
                    ->html()
                    ->formatStateUsing(fn (?string $state) => $state
                        ? collect(explode(',', $state))->map(fn ($e) => e(trim($e)))->filter()->implode('<br>')
                        : '—')
                    ->toggleable(),
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

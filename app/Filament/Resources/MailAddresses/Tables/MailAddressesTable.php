<?php

namespace App\Filament\Resources\MailAddresses\Tables;

use App\Models\MailAddress;
use App\Support\MagicLink;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
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
                Action::make('magicLink')
                    ->label('Link de acesso')
                    ->icon('heroicon-o-key')
                    ->color('gray')
                    // Only for addresses that are a login account (user email = the address).
                    ->visible(fn (MailAddress $r) => $r->user && strtolower($r->user->email) === strtolower($r->local_part.'@'.$r->domain))
                    ->modalHeading('Link de acesso')
                    ->modalDescription(fn (MailAddress $r) => 'Para '.$r->user->email.'. Válido 7 dias, uso único. Copie e envie à pessoa.')
                    ->fillForm(fn (MailAddress $r) => ['link' => MagicLink::generate($r->user, minutes: 60 * 24 * 7)])
                    ->schema([
                        Textarea::make('link')
                            ->label('Link de acesso')
                            ->rows(3)
                            ->readOnly()
                            ->dehydrated(false)
                            ->extraInputAttributes(['onclick' => 'this.select()'])
                            ->helperText('Clique para selecionar, depois copie e envie (WhatsApp, etc.).'),
                    ])
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Fechar'),
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

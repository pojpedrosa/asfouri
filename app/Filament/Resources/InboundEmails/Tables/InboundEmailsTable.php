<?php

namespace App\Filament\Resources\InboundEmails\Tables;

use App\Models\InboundEmail;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class InboundEmailsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_read')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-s-envelope')
                    ->trueColor('gray')
                    ->falseColor('primary'),
                TextColumn::make('from')
                    ->label('De')
                    ->state(fn (InboundEmail $r) => $r->from_name ?: $r->from_email)
                    ->description(fn (InboundEmail $r) => $r->from_name ? $r->from_email : null)
                    ->weight(fn (InboundEmail $r) => $r->is_read ? null : 'bold')
                    ->searchable(['from_name', 'from_email']),
                TextColumn::make('subject')
                    ->label('Assunto')
                    ->placeholder('(sem assunto)')
                    ->weight(fn (InboundEmail $r) => $r->is_read ? null : 'bold')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('recipient')
                    ->label('Para')
                    ->badge()
                    ->color('gray')
                    ->toggleable(),
                TextColumn::make('received_at')
                    ->label('Recebido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_read')->label('Lido'),
            ])
            ->recordActions([
                ViewAction::make()->label('Abrir'),
                Action::make('toggleRead')
                    ->label(fn (InboundEmail $r) => $r->is_read ? 'Marcar não lido' : 'Marcar lido')
                    ->icon('heroicon-o-envelope')
                    ->action(fn (InboundEmail $r) => $r->update(['is_read' => ! $r->is_read])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('received_at', 'desc');
    }
}

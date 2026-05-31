<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use App\Models\ContactMessage;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('handled')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-s-bell-alert')
                    ->trueColor('gray')
                    ->falseColor('primary'),
                TextColumn::make('name')
                    ->label('Nome')
                    ->weight(fn (ContactMessage $r) => $r->handled ? null : 'bold')
                    ->description(fn (ContactMessage $r) => $r->email)
                    ->searchable(['name', 'email']),
                TextColumn::make('subject')
                    ->label('Assunto')
                    ->placeholder('—')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('locale')
                    ->label('Idioma')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Recebido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('handled')->label('Tratado'),
            ])
            ->recordActions([
                EditAction::make()->label('Abrir'),
                Action::make('toggleHandled')
                    ->label(fn (ContactMessage $r) => $r->handled ? 'Reabrir' : 'Marcar tratado')
                    ->icon('heroicon-o-check')
                    ->action(fn (ContactMessage $r) => $r->update(['handled' => ! $r->handled])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}

<?php

namespace App\Filament\Resources\InboundEmails;

use App\Filament\Resources\InboundEmails\Pages\ListInboundEmails;
use App\Filament\Resources\InboundEmails\Tables\InboundEmailsTable;
use App\Models\InboundEmail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InboundEmailResource extends Resource
{
    protected static ?string $model = InboundEmail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static string|\UnitEnum|null $navigationGroup = 'Correio';

    protected static ?string $navigationLabel = 'Caixa de entrada';

    protected static ?string $modelLabel = 'conversa';

    protected static ?string $pluralModelLabel = 'conversas';

    protected static ?int $navigationSort = 1;

    public static function table(Table $table): Table
    {
        return InboundEmailsTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    /** Each user sees only their own inbox. */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    /** Unread INBOUND messages only (outbound never counts). */
    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('user_id', auth()->id())
            ->where('is_read', false)
            ->where(fn ($q) => $q->where('direction', 'inbound')->orWhereNull('direction'))
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInboundEmails::route('/'),
        ];
    }
}

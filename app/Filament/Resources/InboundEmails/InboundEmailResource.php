<?php

namespace App\Filament\Resources\InboundEmails;

use App\Filament\Resources\InboundEmails\Pages\ListInboundEmails;
use App\Filament\Resources\InboundEmails\Pages\ViewInboundEmail;
use App\Filament\Resources\InboundEmails\Schemas\InboundEmailInfolist;
use App\Filament\Resources\InboundEmails\Tables\InboundEmailsTable;
use App\Models\InboundEmail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InboundEmailResource extends Resource
{
    protected static ?string $model = InboundEmail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static string|\UnitEnum|null $navigationGroup = 'Correio';

    protected static ?string $navigationLabel = 'Caixa de entrada';

    protected static ?string $modelLabel = 'email';

    protected static ?string $pluralModelLabel = 'emails';

    protected static ?int $navigationSort = 1;

    public static function infolist(Schema $schema): Schema
    {
        return InboundEmailInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InboundEmailsTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('is_read', false)->count();

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
            'view' => ViewInboundEmail::route('/{record}'),
        ];
    }
}

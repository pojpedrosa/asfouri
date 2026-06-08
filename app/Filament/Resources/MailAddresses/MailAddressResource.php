<?php

namespace App\Filament\Resources\MailAddresses;

use App\Filament\Resources\MailAddresses\Pages\CreateMailAddress;
use App\Filament\Resources\MailAddresses\Pages\EditMailAddress;
use App\Filament\Resources\MailAddresses\Pages\ListMailAddresses;
use App\Filament\Resources\MailAddresses\Schemas\MailAddressForm;
use App\Filament\Resources\MailAddresses\Tables\MailAddressesTable;
use App\Models\MailAddress;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MailAddressResource extends Resource
{
    protected static ?string $model = MailAddress::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAtSymbol;

    protected static string|\UnitEnum|null $navigationGroup = 'Correio';

    protected static ?string $navigationLabel = 'Endereços';

    protected static ?string $modelLabel = 'endereço';

    protected static ?string $pluralModelLabel = 'endereços';

    protected static ?int $navigationSort = 20;

    public static function canViewAny(): bool
    {
        return (bool) auth()->user()?->isAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return MailAddressForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MailAddressesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMailAddresses::route('/'),
            'create' => CreateMailAddress::route('/create'),
            'edit' => EditMailAddress::route('/{record}/edit'),
        ];
    }
}

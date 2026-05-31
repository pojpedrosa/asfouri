<?php

namespace App\Filament\Resources\MailAccounts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MailAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(120)
                        ->helperText('Pessoa ou identidade dona dos endereços. Ex.: Ana Bárbara, Geral'),
                    Toggle::make('active')
                        ->label('Activo')
                        ->default(true),
                    TextInput::make('forward_to')
                        ->label('Reencaminhamento padrão')
                        ->columnSpanFull()
                        ->maxLength(500)
                        ->helperText('Destino(s) por omissão para esta conta (informativo). Cada endereço define o seu próprio reencaminhamento.'),
                    TextInput::make('notes')
                        ->label('Notas')
                        ->columnSpanFull()
                        ->maxLength(255),
                ]),
        ]);
    }
}

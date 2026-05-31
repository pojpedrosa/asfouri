<?php

namespace App\Filament\Resources\MailAddresses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class MailAddressForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Endereço')
                ->columns(2)
                ->schema([
                    TextInput::make('local_part')
                        ->label('Caixa')
                        ->required()
                        ->maxLength(64)
                        ->regex('/^[a-z0-9._-]+$/i')
                        ->helperText('Sem @. Ex.: hello, ana, geral')
                        ->dehydrateStateUsing(fn ($state) => strtolower(trim((string) $state))),
                    TextInput::make('domain')
                        ->label('Domínio')
                        ->default('asfouri.media')
                        ->required()
                        ->maxLength(255),
                    Select::make('mail_account_id')
                        ->label('Conta')
                        ->relationship('account', 'name')
                        ->searchable()
                        ->preload()
                        ->columnSpanFull()
                        ->helperText('A quem pertence este endereço (opcional).'),
                ]),

            Section::make('Entrega')
                ->description('Cada endereço é livre: reencaminhar para fora, guardar na caixa de entrada do back office, ou ambos.')
                ->columns(2)
                ->schema([
                    TextInput::make('forward_to')
                        ->label('Reencaminhar para')
                        ->columnSpanFull()
                        ->maxLength(500)
                        ->helperText('Um ou mais endereços externos, separados por vírgula. Vazio = não reencaminha.')
                        ->rules([
                            fn (Get $get) => function (string $attribute, $value, \Closure $fail) use ($get) {
                                foreach (array_filter(array_map('trim', explode(',', (string) $value))) as $p) {
                                    if (! filter_var($p, FILTER_VALIDATE_EMAIL)) {
                                        $fail("Endereço inválido: {$p}");
                                        return;
                                    }
                                }
                                if (trim((string) $value) === '' && ! $get('deliver_to_inbox')) {
                                    $fail('Escolha pelo menos um destino: reencaminhar e/ou guardar na caixa de entrada.');
                                }
                            },
                        ])
                        ->dehydrateStateUsing(fn ($state) => collect(explode(',', (string) $state))
                            ->map(fn ($s) => strtolower(trim($s)))->filter()->implode(', ') ?: null),
                    Toggle::make('deliver_to_inbox')
                        ->label('Guardar na caixa de entrada')
                        ->default(true)
                        ->helperText('Mostra os emails recebidos no back office.'),
                    Toggle::make('enabled')
                        ->label('Activo')
                        ->default(true),
                    TextInput::make('notes')->label('Notas')->maxLength(255)->columnSpanFull(),
                ]),
        ]);
    }
}

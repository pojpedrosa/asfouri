<?php

namespace App\Filament\Resources\MailAddresses\Schemas;

use App\Models\MailAddress;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class MailAddressForm
{
    /** Is this address a login account (its user's email equals the address)? */
    public static function isAccount(?MailAddress $record): bool
    {
        return $record && $record->user
            && strtolower($record->user->email) === strtolower($record->local_part.'@'.$record->domain);
    }

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
                        ->helperText('Sem @. Ex.: hello, imatos, geral')
                        ->dehydrateStateUsing(fn ($state) => strtolower(trim((string) $state))),
                    TextInput::make('domain')
                        ->label('Domínio')
                        ->default('asfouri.media')
                        ->required()
                        ->maxLength(255),
                ]),

            Section::make('Tipo')
                ->schema([
                    Toggle::make('has_login')
                        ->label('Conta com acesso ao back office')
                        ->default(true)
                        ->live()
                        ->hiddenOn('edit')
                        ->helperText('Ligado: a pessoa recebe um login próprio e a sua caixa de entrada. Desligado: é um alias que entrega numa caixa já existente (por omissão, a sua).'),

                    // --- Account profile (the person's login) — on create, or when editing an account ---
                    TextInput::make('account_name')
                        ->label('Nome da pessoa')
                        ->maxLength(120)
                        ->visible(fn (Get $get, ?MailAddress $record, string $operation) => $operation === 'create' ? (bool) $get('has_login') : static::isAccount($record))
                        ->required(fn (Get $get, ?MailAddress $record, string $operation) => $operation === 'create' ? (bool) $get('has_login') : static::isAccount($record)),
                    TextInput::make('account_password')
                        ->label(fn (string $operation) => $operation === 'edit' ? 'Nova palavra-passe' : 'Palavra-passe (opcional)')
                        ->password()
                        ->revealable()
                        ->maxLength(255)
                        ->autocomplete('new-password')
                        ->visible(fn (Get $get, ?MailAddress $record, string $operation) => $operation === 'create' ? (bool) $get('has_login') : static::isAccount($record))
                        ->helperText(fn (string $operation) => $operation === 'edit'
                            ? 'Defina uma nova palavra-passe para esta pessoa. Deixe vazio para manter a atual.'
                            : 'Opcional. Se vazio, a pessoa entra por link mágico ou recuperação de palavra-passe.'),

                    // --- Alias destination (only for aliases) ---
                    Select::make('user_id')
                        ->label('Entregar na caixa de')
                        ->options(fn () => User::orderBy('name')->get()->mapWithKeys(fn (User $u) => [$u->id => $u->name.' ('.$u->email.')']))
                        ->default(fn () => auth()->id())
                        ->searchable()
                        ->native(false)
                        ->visible(fn (Get $get, ?MailAddress $record, string $operation) => $operation === 'create' ? ! (bool) $get('has_login') : ! static::isAccount($record))
                        ->required(fn (Get $get, ?MailAddress $record, string $operation) => $operation === 'create' ? ! (bool) $get('has_login') : ! static::isAccount($record)),
                ]),

            Section::make('Opções')
                ->columns(2)
                ->schema([
                    TextInput::make('forward_to')
                        ->label('Reencaminhar também para (opcional)')
                        ->columnSpanFull()
                        ->maxLength(500)
                        ->helperText('Endereço(s) externo(s), separados por vírgula. Além da caixa, envia uma cópia para fora.')
                        ->rules([
                            function () {
                                return function (string $attribute, $value, \Closure $fail) {
                                    foreach (array_filter(array_map('trim', explode(',', (string) $value))) as $p) {
                                        if (! filter_var($p, FILTER_VALIDATE_EMAIL)) {
                                            $fail("Endereço inválido: {$p}");
                                        }
                                    }
                                };
                            },
                        ])
                        ->dehydrateStateUsing(fn ($state) => collect(explode(',', (string) $state))
                            ->map(fn ($s) => strtolower(trim($s)))->filter()->implode(', ') ?: null),
                    Toggle::make('enabled')->label('Activo')->default(true),
                ]),
        ]);
    }
}

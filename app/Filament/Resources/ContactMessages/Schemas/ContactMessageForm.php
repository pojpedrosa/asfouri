<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(2)
                ->schema([
                    TextInput::make('name')->label('Nome')->disabled(),
                    TextInput::make('email')->label('Email')->disabled(),
                    TextInput::make('organisation')->label('Organização')->disabled(),
                    TextInput::make('subject')->label('Assunto')->disabled(),
                    Textarea::make('message')->label('Mensagem')->rows(8)->columnSpanFull()->disabled(),
                    Toggle::make('handled')->label('Tratado'),
                ]),
        ]);
    }
}

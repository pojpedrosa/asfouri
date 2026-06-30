<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Pessoa')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(120),
                    FileUpload::make('photo_path')
                        ->label('Fotografia')
                        ->image()
                        ->avatar()
                        ->disk('public')
                        ->directory('team')
                        ->imageEditor(),
                ]),

            Section::make('Função e biografia')
                ->columns(2)
                ->schema([
                    TextInput::make('role_pt')
                        ->label('Função (PT)')
                        ->maxLength(255),
                    TextInput::make('role_en')
                        ->label('Função (EN)')
                        ->maxLength(255),
                    Textarea::make('bio_pt')
                        ->label('Biografia (PT)')
                        ->rows(4)
                        ->columnSpanFull(),
                    Textarea::make('bio_en')
                        ->label('Biografia (EN)')
                        ->rows(4)
                        ->columnSpanFull(),
                ]),

            Section::make('Redes (opcional)')
                ->columns(2)
                ->schema([
                    TextInput::make('instagram_url')
                        ->label('Instagram')
                        ->url()
                        ->maxLength(255),
                    TextInput::make('linkedin_url')
                        ->label('LinkedIn')
                        ->url()
                        ->maxLength(255),
                    TextInput::make('bluesky_url')
                        ->label('Bluesky')
                        ->url()
                        ->maxLength(255),
                    TextInput::make('website_url')
                        ->label('Website')
                        ->url()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->maxLength(255),
                ]),

            Section::make('Publicação')
                ->columns(2)
                ->schema([
                    TextInput::make('sort_order')
                        ->label('Ordem')
                        ->numeric()
                        ->default(0)
                        ->helperText('Número menor aparece primeiro.'),
                    Toggle::make('is_published')
                        ->label('Publicado')
                        ->default(true),
                ]),
        ]);
    }
}

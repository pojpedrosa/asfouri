<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Artigo (Português)')
                    ->schema([
                        TextInput::make('title_pt')
                            ->label('Título')
                            ->required()
                            ->maxLength(180)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if (blank($get('slug'))) {
                                    $set('slug', Str::slug((string) $state));
                                }
                            }),
                        Textarea::make('excerpt_pt')
                            ->label('Resumo')
                            ->rows(2)
                            ->helperText('Uma ou duas frases mostradas nos cartões e no topo do artigo.'),
                        RichEditor::make('body_pt')
                            ->label('Conteúdo')
                            ->columnSpanFull(),
                    ]),

                Section::make('Article (English)')
                    ->schema([
                        TextInput::make('title_en')
                            ->label('Title')
                            ->maxLength(180),
                        Textarea::make('excerpt_en')
                            ->label('Excerpt')
                            ->rows(2),
                        RichEditor::make('body_en')
                            ->label('Content')
                            ->columnSpanFull(),
                    ]),

                Section::make('Capa e publicação')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('cover_path')
                            ->label('Imagem de capa')
                            ->image()
                            ->disk('public')
                            ->directory('posts')
                            ->imageEditor()
                            // Accept large photos, but shrink them in the browser before
                            // upload so we never store (or serve) an oversized file.
                            ->maxSize(25 * 1024)
                            ->imageResizeMode('contain')
                            ->imageResizeTargetWidth('2400')
                            ->imageResizeTargetHeight('1600')
                            ->imageResizeUpscale(false)
                            ->helperText('Pode carregar fotografias grandes (até 25 MB) — são reduzidas automaticamente para no máximo 2400×1600 px.')
                            ->columnSpanFull(),
                        TextInput::make('cover_credit')
                            ->label('Créditos da fotografia')
                            ->maxLength(180)
                            ->helperText('Aparece por baixo da imagem no artigo. Ex.: "Foto de Ana Silva / Unsplash".')
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->rules(['alpha_dash'])
                            ->helperText('/jornal/o-teu-slug'),
                        TextInput::make('author_name')
                            ->label('Autor')
                            ->default('asfouri')
                            ->maxLength(120),
                        DateTimePicker::make('published_at')
                            ->label('Data de publicação')
                            ->default(now())
                            ->seconds(false),
                        Toggle::make('is_published')
                            ->label('Publicado')
                            ->default(false)
                            ->helperText('Só aparece no site quando publicado e com data no passado.'),
                    ]),
            ]);
    }
}

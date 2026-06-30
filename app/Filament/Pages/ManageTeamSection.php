<?php

namespace App\Filament\Pages;

use App\Models\TeamSection;
use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageTeamSection extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.manage-team-section';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

    protected static string|\UnitEnum|null $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'Secção da Equipa';

    protected static ?string $title = 'Secção da Equipa';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return (bool) auth()->user()?->isAdmin();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return (bool) auth()->user()?->isAdmin();
    }

    public function mount(): void
    {
        $section = TeamSection::current();

        $this->form->fill([
            'eyebrow_pt' => $section->eyebrow_pt,
            'eyebrow_en' => $section->eyebrow_en,
            'heading_pt' => $section->heading_pt,
            'heading_en' => $section->heading_en,
            'intro_pt' => $section->intro_pt,
            'intro_en' => $section->intro_en,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cabeçalho')
                    ->columns(2)
                    ->schema([
                        TextInput::make('eyebrow_pt')
                            ->label('Sobre-título (PT)')
                            ->maxLength(255),
                        TextInput::make('eyebrow_en')
                            ->label('Sobre-título (EN)')
                            ->maxLength(255),
                        TextInput::make('heading_pt')
                            ->label('Título (PT)')
                            ->maxLength(255),
                        TextInput::make('heading_en')
                            ->label('Título (EN)')
                            ->maxLength(255),
                        Textarea::make('intro_pt')
                            ->label('Introdução (PT)')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('intro_en')
                            ->label('Introdução (EN)')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        TeamSection::current()->update([
            'eyebrow_pt' => $state['eyebrow_pt'] ?? null,
            'eyebrow_en' => $state['eyebrow_en'] ?? null,
            'heading_pt' => $state['heading_pt'] ?? null,
            'heading_en' => $state['heading_en'] ?? null,
            'intro_pt' => $state['intro_pt'] ?? null,
            'intro_en' => $state['intro_en'] ?? null,
        ]);

        Notification::make()->success()->title('Secção da equipa atualizada')->send();
    }
}

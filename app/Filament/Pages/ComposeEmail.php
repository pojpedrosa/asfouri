<?php

namespace App\Filament\Pages;

use App\Models\MailAddress;
use BackedEnum;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Mail;

class ComposeEmail extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.compose-email';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencilSquare;

    protected static string|\UnitEnum|null $navigationGroup = 'Correio';

    protected static ?string $navigationLabel = 'Escrever';

    protected static ?string $title = 'Escrever email';

    protected static ?int $navigationSort = 5;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'from' => static::fromOptions()->keys()->first(),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('from')
                            ->label('De')
                            ->options(static::fromOptions())
                            ->required()
                            ->native(false)
                            ->helperText('Endereço asfouri.media de onde envia.'),
                        TextInput::make('to')
                            ->label('Para')
                            ->required()
                            ->helperText('Um ou mais endereços, separados por vírgula.')
                            ->rules([
                                function () {
                                    return function (string $attribute, $value, \Closure $fail) {
                                        $parts = array_filter(array_map('trim', explode(',', (string) $value)));
                                        if (empty($parts)) {
                                            $fail('Indique pelo menos um destinatário.');
                                        }
                                        foreach ($parts as $p) {
                                            if (! filter_var($p, FILTER_VALIDATE_EMAIL)) {
                                                $fail("Endereço inválido: {$p}");
                                            }
                                        }
                                    };
                                },
                            ]),
                        TextInput::make('subject')
                            ->label('Assunto')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        RichEditor::make('body')
                            ->label('Mensagem')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    public function send(): void
    {
        $state = $this->form->getState();

        $recipients = collect(explode(',', (string) $state['to']))
            ->map(fn ($s) => trim($s))->filter()->values()->all();

        try {
            Mail::html($state['body'], function ($message) use ($state, $recipients) {
                $message->from($state['from'], 'asfouri')
                    ->to($recipients)
                    ->subject($state['subject']);
            });
        } catch (\Throwable $e) {
            Notification::make()
                ->danger()
                ->title('Não foi possível enviar')
                ->body($e->getMessage())
                ->send();

            return;
        }

        Notification::make()
            ->success()
            ->title('Email enviado')
            ->body('Para: '.implode(', ', $recipients))
            ->send();

        $this->form->fill(['from' => $state['from']]);
    }

    /** Enabled asfouri addresses, as "email => label" for the From select. */
    protected static function fromOptions(): \Illuminate\Support\Collection
    {
        return MailAddress::query()
            ->where('enabled', true)
            ->orderBy('local_part')
            ->get()
            ->mapWithKeys(fn (MailAddress $a) => [$a->local_part.'@'.$a->domain => $a->local_part.'@'.$a->domain]);
    }
}

<?php

namespace App\Filament\Pages;

use App\Models\InboundEmail;
use App\Models\MailAddress;
use App\Support\MailgunSender;
use App\Support\MailThread;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
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
use Illuminate\Support\Facades\Storage;

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
                        FileUpload::make('attachments')
                            ->label('Anexos')
                            ->multiple()
                            ->disk('mail')
                            ->directory('outbound/'.auth()->id())
                            ->visibility('private')
                            ->preventFilePathTampering()
                            ->storeFileNamesIn('attachment_names')
                            ->maxSize(25 * 1024)
                            ->maxFiles(10)
                            ->columnSpanFull()
                            ->helperText('Até 25 MB por ficheiro.'),
                    ]),
            ])
            ->statePath('data');
    }

    public function send(): void
    {
        $state = $this->form->getState();

        $recipients = collect(explode(',', (string) $state['to']))
            ->map(fn ($s) => trim($s))->filter()->values()->all();

        $fromAddress = $state['from'];
        $bodyHtml = (string) $state['body'];

        $address = MailAddress::where('user_id', auth()->id())->get()
            ->first(fn (MailAddress $a) => strtolower($a->local_part.'@'.$a->domain) === strtolower((string) $fromAddress));

        $paths = array_values(array_filter(
            (array) ($state['attachments'] ?? []),
            fn ($p) => is_string($p) && str_starts_with($p, 'outbound/'.auth()->id().'/'),
        ));
        $names = (array) ($state['attachment_names'] ?? []);
        $files = [];
        foreach ($paths as $p) {
            if (Storage::disk('mail')->exists($p)) {
                $files[] = ['contents' => Storage::disk('mail')->get($p), 'name' => $names[$p] ?? basename($p)];
            }
        }

        try {
            $messageId = MailgunSender::send(
                ['from' => $fromAddress, 'to' => $recipients, 'subject' => $state['subject'], 'html' => $bodyHtml],
                null,
                $files,
            );
        } catch (\Throwable $e) {
            Notification::make()->danger()->title('Não foi possível enviar')->body($e->getMessage())->send();

            return;
        }

        $out = InboundEmail::create([
            'mail_address_id' => $address?->id,
            'user_id' => auth()->id(),
            'thread_id' => MailThread::resolve((int) auth()->id(), null, [], $state['subject'], $address?->id, $recipients[0] ?? null),
            'direction' => 'outbound',
            'message_id' => $messageId,
            'recipient' => $fromAddress,
            'to_recipients' => implode(', ', $recipients),
            'from_email' => $fromAddress,
            'from_name' => auth()->user()->name,
            'subject' => $state['subject'],
            'body_html' => $bodyHtml,
            'body_text' => trim(strip_tags($bodyHtml)),
            'has_attachments' => count($files) > 0,
            'is_read' => true,
            'sent_at' => now(),
        ]);

        foreach ($paths as $p) {
            if (Storage::disk('mail')->exists($p)) {
                $out->attachments()->create([
                    'disk' => 'mail',
                    'path' => $p,
                    'filename' => $names[$p] ?? basename($p),
                    'mime' => Storage::disk('mail')->mimeType($p) ?: null,
                    'size' => Storage::disk('mail')->size($p),
                ]);
            }
        }

        Notification::make()->success()->title('Email enviado')->body('Para: '.implode(', ', $recipients))->send();

        $this->form->fill(['from' => $fromAddress]);
    }

    /** The current user's own enabled addresses, as "email => label". */
    protected static function fromOptions(): \Illuminate\Support\Collection
    {
        return MailAddress::query()
            ->where('enabled', true)
            ->where('user_id', auth()->id())
            ->orderBy('local_part')
            ->get()
            ->mapWithKeys(fn (MailAddress $a) => [$a->local_part.'@'.$a->domain => $a->local_part.'@'.$a->domain]);
    }
}

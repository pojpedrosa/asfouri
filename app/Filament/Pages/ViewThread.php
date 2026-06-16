<?php

namespace App\Filament\Pages;

use App\Models\EmailAttachment;
use App\Models\InboundEmail;
use App\Models\MailAddress;
use App\Support\MailgunSender;
use App\Support\MailThread;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;

class ViewThread extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.view-thread';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static bool $shouldRegisterNavigation = false;

    public string $threadId = '';

    public ?array $data = [];

    public static function getRoutePath(Panel $panel): string
    {
        return '/inbox/thread/{record}';
    }

    public function mount(string $record): void
    {
        $this->threadId = $record;

        abort_unless($this->baseQuery()->exists(), 404);

        // Opening a thread marks its unread inbound messages as read.
        $this->baseQuery()->where('direction', 'inbound')->where('is_read', false)->update(['is_read' => true]);

        $this->form->fill();
    }

    public function getTitle(): string
    {
        $first = $this->messages->first();

        return $first ? (MailThread::normalizeSubject($first->subject) ?: '(sem assunto)') : 'Conversa';
    }

    protected function baseQuery()
    {
        return InboundEmail::query()
            ->where('thread_id', $this->threadId)
            ->where('user_id', auth()->id());
    }

    #[Computed]
    public function messages()
    {
        return $this->baseQuery()
            ->with('attachments')
            ->select([
                'id', 'thread_id', 'user_id', 'mail_address_id', 'direction', 'message_id',
                'in_reply_to', 'email_references', 'from_email', 'from_name', 'recipient',
                'to_recipients', 'subject', 'body_text', 'body_html', 'has_attachments',
                'is_read', 'received_at', 'sent_at',
            ])
            ->orderByRaw('COALESCE(received_at, sent_at) asc')
            ->get();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Responder')
                    ->schema([
                        Textarea::make('body')
                            ->label('Mensagem')
                            ->required()
                            ->rows(5)
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
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    public function reply(): void
    {
        $state = $this->form->getState();
        $messages = $this->messages;

        // Reply to the latest inbound message (or the latest message if all outbound).
        $parent = $messages->firstWhere('direction', 'inbound')
            ? $messages->where('direction', 'inbound')->last()
            : $messages->last();

        if (! $parent) {
            Notification::make()->danger()->title('Conversa vazia')->send();

            return;
        }

        // Recipients: the inbound sender, or the original To list if the parent is outbound.
        $to = $parent->isInbound()
            ? array_filter([$parent->from_email])
            : array_filter(array_map('trim', explode(',', (string) $parent->to_recipients)));

        if (empty($to)) {
            Notification::make()->danger()->title('Sem destinatário')->body('Não foi possível determinar para quem responder.')->send();

            return;
        }

        $fromAddress = $this->resolveFromAddress($messages);
        $subject = 'Re: '.MailThread::normalizeSubject($parent->subject ?? '');
        $bodyHtml = nl2br(e((string) $state['body']));

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
                ['from' => $fromAddress, 'to' => array_values($to), 'subject' => $subject, 'html' => $bodyHtml],
                $parent,
                $files,
            );
        } catch (\Throwable $e) {
            Notification::make()->danger()->title('Não foi possível enviar')->body($e->getMessage())->send();

            return;
        }

        $out = InboundEmail::create([
            'mail_address_id' => $parent->mail_address_id,
            'user_id' => auth()->id(),
            'thread_id' => $this->threadId,
            'direction' => 'outbound',
            'message_id' => $messageId,
            'in_reply_to' => $parent->message_id,
            'email_references' => trim(((string) $parent->email_references).' '.(string) $parent->message_id),
            'recipient' => $fromAddress,
            'to_recipients' => implode(', ', $to),
            'from_email' => $fromAddress,
            'from_name' => auth()->user()->name,
            'subject' => $subject,
            'body_html' => $bodyHtml,
            'body_text' => (string) $state['body'],
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

        Notification::make()->success()->title('Resposta enviada')->send();

        $this->form->fill();
        unset($this->messages); // bust the computed cache so the new message shows
    }

    /** The @asfouri.media address this conversation belongs to (what we reply from). */
    protected function resolveFromAddress($messages): string
    {
        $inbound = $messages->where('direction', 'inbound')->last();
        if ($inbound) {
            if ($inbound->address) {
                return $inbound->address->local_part.'@'.$inbound->address->domain;
            }
            $bare = preg_replace('/\+[^@]*@/', '@', (string) $inbound->recipient);
            if (filled($bare)) {
                return strtolower($bare);
            }
        }

        $addr = MailAddress::where('user_id', auth()->id())->where('enabled', true)->orderBy('id')->first();

        return $addr ? $addr->local_part.'@'.$addr->domain : (string) auth()->user()->email;
    }
}

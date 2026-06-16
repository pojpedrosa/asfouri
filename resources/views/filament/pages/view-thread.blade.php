<x-filament-panels::page>
    <div style="display:flex;flex-direction:column;gap:0.9rem;">
        @foreach ($this->messages as $m)
            @php $out = $m->direction === 'outbound'; @endphp
            <div style="display:flex;{{ $out ? 'justify-content:flex-end' : 'justify-content:flex-start' }};">
                <div style="max-width:82%;border-radius:0.85rem;padding:0.85rem 1.05rem;border:1px solid {{ $out ? '#e2a988' : '#e7ddca' }};background:{{ $out ? '#fbf0e9' : '#ffffff' }};box-shadow:0 1px 2px rgba(0,0,0,0.04);">
                    <div style="display:flex;justify-content:space-between;gap:1rem;align-items:baseline;font-size:0.8rem;color:#6f4f30;margin-bottom:0.45rem;">
                        <strong>
                            @if ($out)
                                Eu <span style="color:#a4472a;">→ {{ $m->to_recipients }}</span>
                            @else
                                {{ $m->from_name ?: $m->from_email }}
                                @if ($m->from_name && $m->from_email)<span style="color:#b3936a;">&lt;{{ $m->from_email }}&gt;</span>@endif
                            @endif
                        </strong>
                        <span style="white-space:nowrap;">
                            @if ($out)<span style="color:#a4472a;">enviado · </span>@endif
                            {{ optional($m->received_at ?? $m->sent_at)?->timezone(config('app.timezone'))->format('d/m/Y H:i') }}
                        </span>
                    </div>

                    @if (filled($m->body_html))
                        <iframe sandbox referrerpolicy="no-referrer"
                                style="width:100%;height:340px;border:1px solid #f0e8d6;border-radius:0.5rem;background:#fff;"
                                srcdoc="{{ $m->body_html }}"></iframe>
                    @else
                        <div style="white-space:pre-wrap;color:#20160d;font-size:0.95rem;line-height:1.5;">{{ $m->body_text ?: '(sem conteúdo)' }}</div>
                    @endif

                    @if ($m->attachments->isNotEmpty())
                        <div style="margin-top:0.6rem;display:flex;flex-wrap:wrap;gap:0.4rem;">
                            @foreach ($m->attachments as $att)
                                <a href="{{ route('mail.attachment', $att) }}"
                                   style="font-size:0.78rem;border:1px solid #d2bd9c;border-radius:9999px;padding:0.2rem 0.7rem;color:#a4472a;text-decoration:none;background:#fff;">
                                    📎 {{ $att->filename }}@if ($att->human_size) <span style="color:#8f6c45;">· {{ $att->human_size }}</span>@endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <form wire:submit="reply" style="margin-top:1.5rem;">
        {{ $this->form }}
        <div style="margin-top:0.75rem;display:flex;justify-content:flex-end;">
            <x-filament::button type="submit" icon="heroicon-o-paper-airplane" wire:loading.attr="disabled">
                Responder
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>

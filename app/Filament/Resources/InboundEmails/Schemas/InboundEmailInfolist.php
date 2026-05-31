<?php

namespace App\Filament\Resources\InboundEmails\Schemas;

use App\Models\InboundEmail;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InboundEmailInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(2)
                ->schema([
                    TextEntry::make('subject')->label('Assunto')->columnSpanFull()->weight('bold')->size('lg')->placeholder('(sem assunto)'),
                    TextEntry::make('from')->label('De')->state(fn (InboundEmail $r) => trim(($r->from_name ? $r->from_name.' ' : '').'<'.$r->from_email.'>', ' ')),
                    TextEntry::make('recipient')->label('Para')->badge()->color('gray'),
                    TextEntry::make('received_at')->label('Recebido')->dateTime('d/m/Y H:i'),
                    TextEntry::make('address.account.name')->label('Conta')->placeholder('—'),
                ]),

            Section::make('Mensagem')
                ->schema([
                    TextEntry::make('body_html')
                        ->hiddenLabel()
                        ->html()
                        ->visible(fn (InboundEmail $r) => filled($r->body_html))
                        ->state(fn (InboundEmail $r) => $r->body_html),
                    TextEntry::make('body_text')
                        ->hiddenLabel()
                        ->visible(fn (InboundEmail $r) => blank($r->body_html))
                        ->prose()
                        ->placeholder('(sem corpo de texto)')
                        ->state(fn (InboundEmail $r) => $r->body_text),
                ]),
        ]);
    }
}

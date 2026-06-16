<?php

namespace App\Filament\Resources\InboundEmails\Tables;

use App\Filament\Pages\ViewThread;
use App\Models\InboundEmail;
use App\Support\MailThread;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InboundEmailsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // One row per conversation: the most recent message of each thread.
            ->modifyQueryUsing(fn (Builder $q) => $q
                ->whereIn('id', InboundEmail::query()
                    ->where('user_id', auth()->id())
                    ->selectRaw('MAX(id) as id')
                    ->groupBy(DB::raw("COALESCE(thread_id, 'id-' || id)")))
                ->orderByRaw('COALESCE(received_at, sent_at) desc'))
            ->columns([
                IconColumn::make('is_read')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-s-envelope')
                    ->trueColor('gray')
                    ->falseColor('primary'),
                TextColumn::make('participant')
                    ->label('Conversa com')
                    ->state(fn (InboundEmail $r) => $r->participant)
                    ->weight(fn (InboundEmail $r) => $r->is_read ? null : 'bold')
                    ->searchable(['from_name', 'from_email', 'to_recipients']),
                TextColumn::make('subject')
                    ->label('Assunto')
                    ->state(fn (InboundEmail $r) => MailThread::normalizeSubject($r->subject) ?: '(sem assunto)')
                    ->weight(fn (InboundEmail $r) => $r->is_read ? null : 'bold')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('count')
                    ->label('')
                    ->badge()
                    ->color('gray')
                    ->state(fn (InboundEmail $r) => InboundEmail::where('thread_id', $r->thread_id)->where('user_id', $r->user_id)->count())
                    ->tooltip('Mensagens na conversa'),
                IconColumn::make('attach')
                    ->label('')
                    ->icon('heroicon-m-paper-clip')
                    ->color('gray')
                    ->state(fn (InboundEmail $r) => InboundEmail::where('thread_id', $r->thread_id)->where('user_id', $r->user_id)->where('has_attachments', true)->exists()),
                TextColumn::make('dated_at')
                    ->label('Data')
                    ->state(fn (InboundEmail $r) => $r->received_at ?? $r->sent_at)
                    ->dateTime('d/m/Y H:i')
                    ->sortable(query: fn (Builder $q, string $direction) => $q->orderByRaw('COALESCE(received_at, sent_at) '.$direction)),
            ])
            ->filters([
                TernaryFilter::make('is_read')->label('Lido'),
            ])
            ->recordActions([
                Action::make('open')
                    ->label('Abrir conversa')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->url(fn (InboundEmail $r) => ViewThread::getUrl(['record' => $r->thread_id])),
                Action::make('toggleRead')
                    ->label(fn (InboundEmail $r) => $r->is_read ? 'Marcar não lido' : 'Marcar lido')
                    ->icon('heroicon-o-envelope')
                    ->action(fn (InboundEmail $r) => $r->update(['is_read' => ! $r->is_read])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Deletes the WHOLE conversation(s), not just the shown row, and
                    // removes attachment files from disk (DB cascade can't reach them).
                    BulkAction::make('deleteThreads')
                        ->label('Eliminar conversa(s)')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records) {
                            $threadIds = $records->pluck('thread_id')->unique()->filter();
                            $emails = InboundEmail::whereIn('thread_id', $threadIds)
                                ->where('user_id', auth()->id())
                                ->with('attachments')
                                ->get();

                            foreach ($emails as $email) {
                                foreach ($email->attachments as $att) {
                                    Storage::disk($att->disk)->delete($att->path);
                                }
                            }

                            InboundEmail::whereIn('thread_id', $threadIds)
                                ->where('user_id', auth()->id())
                                ->delete();
                        }),
                ]),
            ]);
    }
}

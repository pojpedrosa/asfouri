<?php

namespace App\Support;

use App\Models\InboundEmail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MailgunSender
{
    /**
     * Send a message via the Mailgun /messages endpoint and return the
     * normalized (bracket-stripped) Message-ID of the sent message.
     *
     * @param  array{from:string,to:array<int,string>|string,subject:string,html:string}  $data
     * @param  array<int,array{contents:string,name:string}>  $files
     */
    public static function send(array $data, ?InboundEmail $parent = null, array $files = []): string
    {
        $secret = config('services.mailgun.secret');
        $domain = config('services.mailgun.domain');
        $endpoint = config('services.mailgun.endpoint', 'api.eu.mailgun.net');

        if (blank($secret) || blank($domain)) {
            throw new \RuntimeException('O Mailgun não está configurado (falta a chave).');
        }

        $html = (string) ($data['html'] ?? '');
        $form = [
            'from' => $data['from'],
            'to' => is_array($data['to']) ? implode(',', $data['to']) : $data['to'],
            'subject' => (string) ($data['subject'] ?? ''),
            'html' => $html,
            'text' => trim(strip_tags($html)),
        ];

        // Thread the reply so it lands in the same conversation in Gmail etc.
        if ($parent && filled($parent->message_id)) {
            $form['h:In-Reply-To'] = '<'.$parent->message_id.'>';

            $chain = array_filter(array_merge(
                preg_split('/\s+/', (string) $parent->email_references) ?: [],
                [$parent->message_id],
            ));
            $chain = array_slice(array_values(array_unique($chain)), -20);
            $form['h:References'] = implode(' ', array_map(fn ($id) => '<'.trim($id, '<>').'>', $chain));
        }

        $request = Http::withBasicAuth('api', $secret)->timeout(30);
        foreach (array_values($files) as $i => $file) {
            $request = $request->attach("attachment[$i]", $file['contents'], $file['name'] ?? ('anexo-'.($i + 1)));
        }

        $response = $request->post("https://{$endpoint}/v3/{$domain}/messages", $form);

        if (! $response->successful()) {
            throw new \RuntimeException('Mailgun '.$response->status().': '.$response->body());
        }

        return MailThread::cleanId($response->json('id')) ?? ('sent-'.Str::uuid());
    }
}

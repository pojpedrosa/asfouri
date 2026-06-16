<?php

namespace App\Http\Controllers;

use App\Models\EmailAttachment;
use Illuminate\Support\Facades\Storage;

class MailAttachmentController extends Controller
{
    public function download(EmailAttachment $attachment)
    {
        $email = $attachment->email;

        abort_unless(
            $email && ($email->user_id === auth()->id() || auth()->user()?->isAdmin()),
            403,
        );
        abort_unless(Storage::disk($attachment->disk)->exists($attachment->path), 404);

        return Storage::disk($attachment->disk)->download(
            $attachment->path,
            $attachment->filename,
            $attachment->mime ? ['Content-Type' => $attachment->mime] : [],
        );
    }
}

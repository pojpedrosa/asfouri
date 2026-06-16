<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inbound_emails', function (Blueprint $table) {
            $table->string('thread_id')->nullable()->after('user_id')->index();
            $table->string('direction')->default('inbound')->after('thread_id'); // inbound | outbound
            $table->string('in_reply_to')->nullable()->after('message_id');
            $table->text('email_references')->nullable()->after('in_reply_to'); // "references" is reserved
            $table->text('to_recipients')->nullable()->after('recipient');
            $table->boolean('has_attachments')->default(false)->after('raw');
            $table->timestamp('sent_at')->nullable()->after('received_at');
            $table->index(['user_id', 'thread_id']);
        });
    }

    public function down(): void
    {
        Schema::table('inbound_emails', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'thread_id']);
            $table->dropColumn([
                'thread_id', 'direction', 'in_reply_to', 'email_references',
                'to_recipients', 'has_attachments', 'sent_at',
            ]);
        });
    }
};

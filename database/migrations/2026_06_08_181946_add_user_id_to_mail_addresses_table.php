<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mail_addresses', function (Blueprint $table) {
            // The back-office user whose inbox receives mail to this address.
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('mail_addresses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }
};

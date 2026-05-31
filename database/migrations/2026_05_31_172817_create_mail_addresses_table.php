<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mail_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mail_account_id')->nullable()->constrained()->nullOnDelete();
            $table->string('local_part');                     // part before the @
            $table->string('domain')->default('asfouri.media');
            $table->string('forward_to')->nullable();         // comma-separated external destinations
            $table->boolean('deliver_to_inbox')->default(true); // also keep a copy in the admin inbox
            $table->boolean('enabled')->default(true);
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->unique(['local_part', 'domain']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_addresses');
    }
};

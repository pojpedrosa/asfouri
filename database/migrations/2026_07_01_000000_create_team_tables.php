<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role_pt')->nullable();
            $table->string('role_en')->nullable();
            $table->text('bio_pt')->nullable();
            $table->text('bio_en')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('bluesky_url')->nullable();
            $table->string('website_url')->nullable();
            $table->string('email')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // Singleton: exactly one row (id=1). Seeded here with sensible bilingual
        // defaults so the public view never writes-on-read; editable in the admin.
        Schema::create('team_sections', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow_pt')->nullable();
            $table->string('eyebrow_en')->nullable();
            $table->string('heading_pt')->nullable();
            $table->string('heading_en')->nullable();
            $table->text('intro_pt')->nullable();
            $table->text('intro_en')->nullable();
            $table->timestamps();
        });

        DB::table('team_sections')->insert([
            'id' => 1,
            'eyebrow_pt' => 'Equipa',
            'eyebrow_en' => 'Team',
            'heading_pt' => 'Quem cuida da asfouri',
            'heading_en' => 'The people behind asfouri',
            'intro_pt' => 'Um coletivo pequeno e próximo. Estas são as pessoas que cultivam cada projeto, do primeiro rascunho à colheita.',
            'intro_en' => 'A small, close-knit collective. These are the people who tend every project, from the first draft to the harvest.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_sections');
        Schema::dropIfExists('team_members');
    }
};

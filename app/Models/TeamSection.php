<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamSection extends Model
{
    protected $fillable = [
        'eyebrow_pt', 'eyebrow_en',
        'heading_pt', 'heading_en',
        'intro_pt', 'intro_en',
    ];

    /** The singleton row, created with sensible bilingual defaults on first access. */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'eyebrow_pt' => 'Equipa',
            'eyebrow_en' => 'Team',
            'heading_pt' => 'Quem cuida da asfouri',
            'heading_en' => 'The people behind asfouri',
            'intro_pt' => 'Um coletivo pequeno e próximo. Estas são as pessoas que cultivam cada projeto, do primeiro rascunho à colheita.',
            'intro_en' => 'A small, close-knit collective. These are the people who tend every project, from the first draft to the harvest.',
        ]);
    }

    /** Locale-aware eyebrow, falling back to the other language when empty. */
    public function eyebrow(): ?string
    {
        return app()->getLocale() === 'en'
            ? ($this->eyebrow_en ?: $this->eyebrow_pt)
            : ($this->eyebrow_pt ?: $this->eyebrow_en);
    }

    /** Locale-aware heading, falling back to the other language when empty. */
    public function heading(): ?string
    {
        return app()->getLocale() === 'en'
            ? ($this->heading_en ?: $this->heading_pt)
            : ($this->heading_pt ?: $this->heading_en);
    }

    /** Locale-aware intro, falling back to the other language when empty. */
    public function intro(): ?string
    {
        return app()->getLocale() === 'en'
            ? ($this->intro_en ?: $this->intro_pt)
            : ($this->intro_pt ?: $this->intro_en);
    }
}

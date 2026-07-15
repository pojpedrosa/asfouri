<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'slug',
        'title_pt', 'title_en',
        'excerpt_pt', 'excerpt_en',
        'body_pt', 'body_en',
        'cover_path',
        'cover_credit',
        'author_name',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** Locale-aware helpers (EN falls back to PT and vice-versa). */
    public function title(): string
    {
        return app()->getLocale() === 'en'
            ? ($this->title_en ?: $this->title_pt)
            : ($this->title_pt ?: $this->title_en);
    }

    public function excerpt(): ?string
    {
        return app()->getLocale() === 'en'
            ? ($this->excerpt_en ?: $this->excerpt_pt)
            : ($this->excerpt_pt ?: $this->excerpt_en);
    }

    public function body(): ?string
    {
        return app()->getLocale() === 'en'
            ? ($this->body_en ?: $this->body_pt)
            : ($this->body_pt ?: $this->body_en);
    }

    public function coverUrl(): ?string
    {
        return $this->cover_path ? Storage::disk('public')->url($this->cover_path) : null;
    }

    /** Rough reading time (minutes) from the current-locale body. */
    public function readingMinutes(): int
    {
        $words = str_word_count(strip_tags((string) $this->body()));

        return max(1, (int) ceil($words / 200));
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');
    }
}

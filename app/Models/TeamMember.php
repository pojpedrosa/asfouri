<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'role_pt', 'role_en',
        'bio_pt', 'bio_en',
        'photo_path',
        'instagram_url', 'linkedin_url', 'bluesky_url', 'website_url', 'email',
        'sort_order', 'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    /** Locale-aware role, falling back to the other language when empty. */
    public function role(): ?string
    {
        return app()->getLocale() === 'en'
            ? ($this->role_en ?: $this->role_pt)
            : ($this->role_pt ?: $this->role_en);
    }

    /** Locale-aware bio, falling back to the other language when empty. */
    public function bio(): ?string
    {
        return app()->getLocale() === 'en'
            ? ($this->bio_en ?: $this->bio_pt)
            : ($this->bio_pt ?: $this->bio_en);
    }

    /** Public URL for the uploaded photo, or null. */
    public function photoUrl(): ?string
    {
        return $this->photo_path
            ? Storage::disk('public')->url($this->photo_path)
            : null;
    }

    /**
     * Ordered list of social links, only the non-empty ones.
     *
     * @return array<int, array{key: string, label: string, url: string, icon: string}>
     */
    public function socials(): array
    {
        $socials = [];

        if ($this->instagram_url) {
            $socials[] = ['key' => 'instagram', 'label' => 'Instagram', 'url' => $this->instagram_url, 'icon' => 'instagram'];
        }

        if ($this->linkedin_url) {
            $socials[] = ['key' => 'linkedin', 'label' => 'LinkedIn', 'url' => $this->linkedin_url, 'icon' => 'linkedin'];
        }

        if ($this->bluesky_url) {
            $socials[] = ['key' => 'bluesky', 'label' => 'Bluesky', 'url' => $this->bluesky_url, 'icon' => 'bluesky'];
        }

        if ($this->website_url) {
            $socials[] = ['key' => 'website', 'label' => 'Website', 'url' => $this->website_url, 'icon' => 'globe'];
        }

        if ($this->email) {
            $socials[] = ['key' => 'email', 'label' => 'Email', 'url' => 'mailto:'.$this->email, 'icon' => 'mail'];
        }

        return $socials;
    }

    /** Published members, ordered for display. */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('name');
    }
}

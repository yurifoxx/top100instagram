<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class InstagramProfile extends Model
{
    protected $fillable = [
        'rank', 'username', 'full_name', 'bio', 'followers_count',
        'following_count', 'posts_count', 'avatar_url', 'profile_url',
        'is_verified', 'category_id', 'country', 'rank_change',
        'is_active', 'last_updated_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'last_updated_at' => 'datetime',
        'followers_count' => 'integer',
        'following_count' => 'integer',
        'posts_count' => 'integer',
        'rank_change' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(RankingHistory::class, 'profile_id');
    }

    public function scopeRanking(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('rank');
    }

    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function getFormattedFollowersAttribute(): string
    {
        $n = $this->followers_count;
        if ($n >= 1_000_000_000) {
            return round($n / 1_000_000_000, 1) . 'B';
        }
        if ($n >= 1_000_000) {
            return round($n / 1_000_000, 1) . 'M';
        }
        if ($n >= 1_000) {
            return round($n / 1_000, 1) . 'K';
        }
        return (string) $n;
    }

    public function getRankTrendAttribute(): string
    {
        if ($this->rank_change > 0) return '▲';
        if ($this->rank_change < 0) return '▼';
        return '—';
    }

    public function getRankTrendColorAttribute(): string
    {
        if ($this->rank_change > 0) return 'text-green-500';
        if ($this->rank_change < 0) return 'text-red-500';
        return 'text-gray-400';
    }
}

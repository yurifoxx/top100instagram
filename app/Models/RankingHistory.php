<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RankingHistory extends Model
{
    public $timestamps = false;

    protected $fillable = ['profile_id', 'rank', 'followers_count', 'recorded_at'];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(InstagramProfile::class, 'profile_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'label', 'icon'];

    public function profiles(): HasMany
    {
        return $this->hasMany(InstagramProfile::class);
    }
}

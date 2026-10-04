<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    protected $fillable = [
        'store_region_id', 'name', 'ward', 'address', 'phone', 'opening_hours', 'note',
        'map_embed_url', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(StoreRegion::class, 'store_region_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
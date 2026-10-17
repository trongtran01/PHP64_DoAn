<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ward extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = 'code';

    protected $fillable = ['code', 'province_code', 'name', 'division_type', 'codename'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }
}
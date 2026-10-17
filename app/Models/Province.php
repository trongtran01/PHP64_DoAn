<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = 'code';

    protected $fillable = ['code', 'name', 'division_type', 'codename'];

    public function wards(): HasMany
    {
        return $this->hasMany(Ward::class, 'province_code', 'code');
    }

    // Để route model binding dùng cột `code` thay vì `id`
    public function getRouteKeyName(): string
    {
        return 'code';
    }
}
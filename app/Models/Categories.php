<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = "categories";

    public $timestamps = false;

    // Cho phép mass assignment cho các field
    protected $fillable = [
        'name',
        'parent_id',
        'display_at_home_page',
    ];
}


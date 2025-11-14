<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address'
    ];

    protected $hidden = [
        'password'
    ];

    // Mutator để tự động hash password khi tạo/upate
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}

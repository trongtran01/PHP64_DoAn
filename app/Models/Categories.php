<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    // Khai báo table model để truy vấn
    protected $table = "categories";
    // Nếu trong table categories không có 2 trường là create_at, update_at thì phải khai báo thêm dòng sau
    public $timestamps = false;
}

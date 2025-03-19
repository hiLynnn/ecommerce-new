<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnhPhuSanPham extends Model
{
    use HasFactory;

    protected $table = 'anh_phu_san_pham';

    protected $fillable = [
        'san_pham_id',
        'duong_dan',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}

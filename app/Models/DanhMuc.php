<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;

    protected $table = 'danh_muc';

    protected $fillable = [
        'ten_danh_muc',
        'slug',
        'mo_ta',
        'hien_thi',
    ];

    protected $casts = [
        'hien_thi' => 'boolean',
    ];

    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'danh_muc_id');
    }
}

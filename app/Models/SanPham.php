<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'san_pham';

    protected $fillable = [
        'ten_san_pham',
        'slug',
        'danh_muc_id',
        'mo_ta',
        'gia',
        'so_luong',
        'anh_dai_dien',
        'hien_thi',
        'noi_bat',
    ];

    protected $casts = [
        'hien_thi' => 'boolean',
        'noi_bat' => 'boolean',
        'gia' => 'integer',
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id');
    }

    public function anhPhu()
    {
        return $this->hasMany(AnhPhuSanPham::class, 'san_pham_id');
    }

    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'san_pham_id');
    }
}

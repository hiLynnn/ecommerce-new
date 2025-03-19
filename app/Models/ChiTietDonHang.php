<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_don_hang';

    protected $fillable = [
        'don_hang_id',
        'san_pham_id',
        'so_luong',
        'don_gia',
        'thanh_tien'
    ];

    protected $casts = [
        'don_gia' => 'decimal:2',
        'thanh_tien' => 'decimal:2'
    ];

    protected static function booted()
    {
        static::creating(function ($chiTietDonHang) {
            $chiTietDonHang->thanh_tien = $chiTietDonHang->so_luong * $chiTietDonHang->don_gia;
        });
    }

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}

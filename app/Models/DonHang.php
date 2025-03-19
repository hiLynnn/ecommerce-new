<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    protected $table = 'don_hang';

    protected $fillable = [
        'nguoi_dung_id',
        'tong_tien',
        'trang_thai',
        'dia_chi_giao',
        'so_dien_thoai',
        'ghi_chu'
    ];

    protected $casts = [
        'tong_tien' => 'decimal:2',
        'trang_thai' => 'string'
    ];

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }

    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'don_hang_id');
    }
}

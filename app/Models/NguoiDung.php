<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NguoiDung extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'nguoi_dung';

    protected $fillable = [
        'ten',
        'email',
        'mat_khau',
        'so_dien_thoai',
        'dia_chi',
        'vai_tro'
    ];

    protected $hidden = [
        'mat_khau',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mat_khau' => 'hashed',
    ];

    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['mat_khau'] = bcrypt($value);
    }

    public function isAdmin()
    {
        return $this->vai_tro === 'admin';
    }

    public function donHang()
    {
        return $this->hasMany(DonHang::class, 'nguoi_dung_id');
    }

    public function gioHangs()
    {
        return $this->hasMany(GioHang::class, 'nguoi_dung_id');
    }
}

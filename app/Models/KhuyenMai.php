<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    use HasFactory;

    protected $table = 'khuyen_mai';

    protected $fillable = [
        'promotions_name',
        'promotions_times',
        'promotions_code',
        'promotions_condition',
        'promotions_number',
        'promotionsdate_start',
        'promotionsdate_end',
    ];
}

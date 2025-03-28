<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhuyenMai extends Model
{
    use HasFactory, SoftDeletes;

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

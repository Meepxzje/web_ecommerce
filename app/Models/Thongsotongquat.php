<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsotongquat extends Model
{
    use HasFactory;

    protected $table = 'thongsotongquat';

    protected $fillable = [
        'sanphamid', 'hedieuhanh', 'anninh', 'banphim', 'thietbidiem', 'kichthuoc', 'trongluong'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
}


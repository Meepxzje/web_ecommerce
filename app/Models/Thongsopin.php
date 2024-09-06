<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsopin extends Model
{
    use HasFactory;

    protected $table = 'thongsopin';


    protected $fillable = [
        'sanphamid', 'pin', 'loai', 'thoigiansudungtoida', 'yeucaunangluong', 'cungcapnangluong'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
}


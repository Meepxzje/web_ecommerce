<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsotruyenthong extends Model
{
    use HasFactory;

    protected $table = 'thongsotruyenthong';

    protected $fillable = [
        'sanphamid', 'ketnoimang', 'modem', 'wifi', 'bluetooth', 'bangthongdidong', 'gps', 'nfc', 'webcam'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    use HasFactory;

    protected $table = 'chitietdonhang';

    protected $fillable = ['donhangid', 'sanphamid', 'soluong', 'gia'];

    public function donhang()
    {
        return $this->belongsTo(Donhang::class, 'donhangid');
    }

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
}


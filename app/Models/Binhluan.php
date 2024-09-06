<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    use HasFactory;
    protected $table = 'binhluan';

    protected $fillable = ['nguoidungid', 'sanphamid', 'noidung'];

    // public function nguoidung()
    // {
    //     return $this->belongsTo(Nguoidung::class, 'nguoidungid');
    // }

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
}


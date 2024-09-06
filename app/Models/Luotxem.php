<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Luotxem extends Model
{
    use HasFactory;

    protected $table = 'luotxemsanpham';

    protected $fillable = [
        'nguoidungid',
        'sanphamid',
    ];


    public function nguoidung()
    {
        return $this->belongsTo(Nguoidung::class, 'nguoidungid');
    }

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }



}

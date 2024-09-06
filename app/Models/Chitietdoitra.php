<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietdoitra extends Model
{
    use HasFactory;

    protected $table = 'chitietdoitras';

    protected $fillable = [
        'doitraid',
        'sanphamid',
        'soluong'
    ];

    public function doitra()
    {
        return $this->belongsTo(Doitra::class, 'doitraid');
    }

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
}

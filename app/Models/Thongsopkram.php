<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsopkram extends Model
{
    use HasFactory;

    protected $table = 'thongsopkram';

    protected $fillable = [
        'sanphamid', 'dungluong', 'tocdobus', 'loairam',
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }

    public function dungluongs()
    {
        return $this->belongsTo(Ram::class, 'dungluong');
    }

    public function tocdobuss()
    {
        return $this->belongsTo(Busram::class, 'tocdobus');
    }

    public function loairams()
    {
        return $this->belongsTo(Loairam::class, 'loairam');
    }
}

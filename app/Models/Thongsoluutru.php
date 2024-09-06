<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsoluutru extends Model
{
    use HasFactory;

    protected $table = 'thongsoluutru';
    protected $fillable = [
        'sanphamid', 'khecamkhadung', 'tongdungluong', 'luutru', 'odia'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
    public function tongdungluongs()
    {
        return $this->belongsTo(Ssd::class, 'tongdungluong');
    }



}


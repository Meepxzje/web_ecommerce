<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsomanhinh extends Model
{
    use HasFactory;
    protected $table = 'thongsomanhinh';

    protected $fillable = [
        'sanphamid', 'loaipanel', 'kichthuoc', 'tylekhunghinh', 'dophangiai', 'manhinhcamung', 'bemat', 'dosang'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }

    public function kichthuocs()
    {
        return $this->belongsTo(Manhinh::class, 'kichthuoc');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsoketnoi extends Model
{
    use HasFactory;

    protected $table = 'thongsoketnoi';
    protected $fillable = [
        'sanphamid', 'cong', 'soluongcong', 'hienthi', 'soluongconghienthi', 'amthanh1', 'amthanh2', 'amthanh3', 'khecaidatmorong', 'docthenho'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsopkbanphim extends Model
{
    use HasFactory;

    protected $table = 'thongsopkbanphim';

    protected $fillable = [
        'sanphamid', 'loaibanphim', 'congketnoi', 'kieudangbanphim',
        'kichthuoc', 'keycap','motakeycap','switch','pin','phukien',
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }
    public function loaibanphims()
    {
        return $this->belongsTo(Loaibanphim::class, 'loaibanphim');
    }
    public function kieudangbanphims()
    {
        return $this->belongsTo(Kieudangbanphim::class, 'kieudangbanphim');
    }
    public function keycaps()
    {
        return $this->belongsTo(Keycap::class, 'keycap');
    }


}

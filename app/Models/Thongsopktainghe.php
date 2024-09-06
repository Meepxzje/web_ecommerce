<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsopktainghe extends Model
{
    use HasFactory;

    protected $table = 'thongsopktainghe';

    protected $fillable = [
        'sanphamid',
        'loaiketnoi',
        'kieutainghe',
        'congketnoi',
        'mausac',
        'micro',
        'day',
        'tuongthich',
        'cacham',
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }

    public function loaiketnois()
    {
        return $this->belongsTo(Loaibanphim::class, 'loaiketnoi');
    }

    public function kieutainghes()
    {
        return $this->belongsTo(Kieutainghe::class, 'kieutainghe');
    }

    public function congketnois()
    {
        return $this->belongsTo(Congketnoi::class, 'congketnoi');
    }

}

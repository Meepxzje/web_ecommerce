<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsopkchuot extends Model
{
    use HasFactory;

    protected $table = 'thongsopkchuot';

    protected $fillable = [
        'sanphamid', 'loaiketnoi', 'kieuketnoi', 'mausac', 'led', 'donhay', 'phukien',
    ];

    public function loaiketnois()
    {
        return $this->belongsTo(Loaibanphim::class, 'loaiketnoi');
    }
    public function kieuketnois()
    {
        return $this->belongsTo(Congketnoi::class, 'loaiketnoi');
    }
}

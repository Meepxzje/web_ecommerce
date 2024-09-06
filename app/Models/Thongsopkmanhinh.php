<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsopkmanhinh extends Model
{
    use HasFactory;

    protected $table = 'thongsopkmanhinh';

    protected $fillable = [
        'sanphamid', 'kichthuoc', 'dophangiai', 'tamnen',
        'tansoquet', 'dosang','dotuongphan','congketnoi',
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }

    public function kichthuocs()
    {
        return $this->belongsTo(Manhinh::class, 'kichthuoc');
    }

    public function dophangiais()
    {
        return $this->belongsTo(Dophangiai::class, 'dophangiai');
    }

    public function tamnens()
    {
        return $this->belongsTo(Tamnen::class, 'tamnen');
    }
    public function tansoquets()
    {
        return $this->belongsTo(Tansoquet::class, 'tansoquet');
    }

}

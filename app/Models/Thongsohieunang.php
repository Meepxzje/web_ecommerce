<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongsohieunang extends Model
{
    use HasFactory;

    protected $table = 'thongsohieunang';
    protected $fillable = [
        'sanphamid', 'cpu', 'tocdoxungnhipcoban', 'tocdoxungnhiptoida', 'ram', 'loaibonho', 'tocdobonho', 'khecambonhokhadung', 'kieudohoa', 'gpu','gpuroi'
    ];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'sanphamid');
    }

    public function cpus()
    {
        return $this->belongsTo(Cpu::class, 'cpu');
    }

    public function gpurois()
    {
        return $this->belongsTo(Gpu::class, 'gpuroi');
    }

    public function rams()
    {
        return $this->belongsTo(Ram::class, 'ram');
    }
}


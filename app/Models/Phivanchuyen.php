<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phivanchuyen extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'phivanchuyen';
    protected $primaryKey = 'id';
    protected $fillable = ['matp', 'phivanchuyen'];

    public function thanhpho()
    {
        return $this->belongsTo(Thanhpho::class, 'matp', 'matp');
    }
}

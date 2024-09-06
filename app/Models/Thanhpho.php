<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thanhpho extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tinhthanhpho';
    protected $primaryKey = 'matp';
    protected $fillable = ['matp','name', 'type'];

    public function phivanchuyen()
    {
        return $this->hasMany(Phivanchuyen::class, 'matp', 'matp');
    }
}

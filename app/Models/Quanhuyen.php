<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quanhuyen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'quanhuyen';
    protected $primaryKey = 'maqh';
    protected $fillable = ['maqh','name', 'type', 'matp'];

    public function phivanchuyen()
    {
        return $this->hasMany(Phivanchuyen::class, 'maqh', 'maqh');
    }
}

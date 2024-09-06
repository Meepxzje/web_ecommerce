<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xaphuong extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $table = 'xaphuongthitran';
    protected $primaryKey = 'xaid';
    protected $fillable = ['xaid','name', 'type', 'maqh'];

    public function phivanchuyen()
    {
        return $this->hasMany(Phivanchuyen::class, 'maxp', 'xaid');
    }

}

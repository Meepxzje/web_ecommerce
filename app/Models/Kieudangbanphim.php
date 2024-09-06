<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kieudangbanphim extends Model
{
    use HasFactory;
    protected $table = 'kieudangbanphims';
    protected $fillable = ['ten'];
}

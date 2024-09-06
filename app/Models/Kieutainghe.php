<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kieutainghe extends Model
{
    use HasFactory;
    protected $table = 'kieutainghes';
    protected $fillable = ['ten'];
}
